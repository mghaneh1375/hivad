<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminFieldResource;
use App\Http\Resources\UserFormFieldResource;
use App\Http\Resources\UserFormResource;
use App\Models\Field;
use App\Models\UserForm;
use App\Models\UserFormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class AdviceFormController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $seen = $request->query('seen');
        if($seen != null && $seen == 'false')
            $forms = UserForm::advice()->unSeen()->orderBy('id', 'desc')->get();
        else
            $forms = UserForm::advice()->orderBy('id', 'desc')->get();

        return view('admin.Survey.forms.list', [
            'mode' => 'advice',
            'forms' => UserFormResource::collection($forms)->toArray($request)
        ]);
    }

    public function showForm(UserForm $form, Request $request)
    {
        
        if(!$form->seen) {
            $form->seen = true;
            $form->save();
        }

        return view('admin.Survey.forms.detail', [
            'fields' => UserFormFieldResource::collection($form->fields)->toArray($request),
            'mode' => 'advice'
        ]);
    }

    public static function submit(Request $request, string $mode) {

        $fields =  $mode == 'advice' ? 
            Field::advice()->visible()->select('slug', 'type', 'is_required', 'options')->get() :
            Field::survey()->visible()->select('slug', 'type', 'is_required', 'options')->get()
        ;
        $validator = [];
        foreach($fields as $field) {

            $tmp = [];

            if($field->is_required)
                array_push($tmp, 'required');
            else
                array_push($tmp, 'nullable');

            if($field->type == 'number')
                array_push($tmp, 'numeric');
            else if($field->type == 'radio' || $field->type == 'checkbox') {
                if($field->options != null) {
                    $options = explode('__', $field->options);
                    array_push($tmp, Rule::in($options));
                }
            }
            else {
                array_push($tmp, 'string');
                if($field->is_required)
                    array_push($tmp, 'min:2');
            }
                
            $validator['filedValue_' . $field->slug] = $tmp;
        }

        $request->validate($validator);
        $ip = self::getIp();

        $userForm = UserForm::create([
            'for' => $mode,
            'ip' => $ip
        ]);

        
        foreach($request->keys() as $key) {
            
            if($key == '_token')
                continue;

            $tmp = explode('filedValue_', $key);
            if(count($tmp) != 2)
                continue;

            $tmp = $tmp[1];
            $field = Field::where('for', $mode)->where('slug', $tmp)->first();

            if($field == null)
                continue;
            
            UserFormField::create([
                'answer' => $request[$key],
                'field_id' => $field->id,
                'user_form_id' => $userForm->id
            ]);

        }
        
        return response()->json(['status' => 'ok', 'sunccess' => true, 'logID' => 1, 'message' => 'فرم شما با موفقیت ثبت گردید.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Survey.question.create', ['mode' => 'advice']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(['checkbox', 'radio', 'text', 'number', 'textarea'])],
            'is_required' => 'required|boolean',
            'visibility' => 'required|boolean',
            'label' => 'required|string|min:2',
            'slug' => 'required|string|min:2',
            'options' => 'nullable|string|min:2',
        ]);

        $request['options'] = implode('__', explode(',', $request['options']));
        $request['for'] = 'advice';
        Field::create($request->toArray());
        return Redirect::route('advice.questions.list');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view('admin.Survey.question.list', [
            'questions' => AdminFieldResource::collection(Field::advice()->get()),
            'mode' => 'advice'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        return view('admin.Survey.question.create', [
            'field' => $field,
            'mode' => 'advice'
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $request->validate([
            'type' => ['nullable', Rule::in(['checkbox', 'radio', 'text', 'number', 'textarea'])],
            'is_required' => 'nullable|boolean',
            'label' => 'nullable|string|min:2',
            'visibility' => 'nullable|boolean',
            'slug' => 'nullable|string|min:2',
            'options' => 'nullable|string|min:2',
        ]);

        if($request->has('options'))
            $field->options = implode('__', explode(',', $request['options']));

        $field->visibility = $request->has('visibility') ? $request['visibility'] : $field->visibility;
        $field->type = $request->has('type') ? $request['type'] : $field->type;
        $field->label = $request->has('label') ? $request['label'] : $field->label;
        $field->slug = $request->has('slug') ? $request['slug'] : $field->slug;
        $field->is_required = $request->has('is_required') ? $request['is_required'] : $field->is_required;
        $field->save();

        return Redirect::route('advice.questions.list');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();
        return response()->json(['status' => 'ok']);
    }

}
