<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminFieldResource;
use App\Http\Resources\UserFormFieldResource;
use App\Http\Resources\UserFormResource;
use App\Models\Field;
use App\Models\Survey;
use App\Models\UserForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class SurveyController extends Controller
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
            $forms = UserForm::survey()->unSeen()->orderBy('id', 'desc')->get();
        else
            $forms = UserForm::survey()->orderBy('id', 'desc')->get();

        return view('admin.Survey.forms.list', [
            'mode' => 'survey',
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
            'mode' => 'survey'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Survey.question.create', ['mode' => 'survey']);
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
        $request['for'] = 'survey';

        Field::create($request->toArray());
        return Redirect::route('survey.questions.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view('admin.Survey.question.list', [
            'questions' => AdminFieldResource::collection(Field::survey()->get()),
            'mode' => 'survey'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field, Request $request)
    {
        return view('admin.Survey.question.create', [
            'field' => AdminFieldResource::make($field)->toArray($request),
            'mode' => 'survey'
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

        return Redirect::route('survey.questions.list');
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
