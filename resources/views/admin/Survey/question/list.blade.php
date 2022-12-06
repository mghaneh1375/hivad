@extends('layouts.structure')

@section('header')
    @parent
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>مدیریت سوالات نظرسنجی</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">
                        
                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route($mode . '.questions.create') }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">
                            <?php $i = 1; ?>
                            <table>
                                <tr>
                                    <td>ردیف</td>
                                    <td>لیبل</td>
                                    <td>وضعیت نمایش</td>
                                    <td>اولویت</td>
                                    <td>آیا این فیلد ضروری است</td>
                                    <td>نوع سوال</td>
                                    <td>عملیات</td>
                                </tr>
                                @foreach($questions as $question)
                                    <tr id="item_{{ $question->id }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $question->label }}</td>
                                        <td>{{ $question->visibility ? 'نمایش' : 'غیر نمایش' }}</td>
                                        <td>{{ $question->priority }}</td>
                                        <td>{{ $question->is_required }}</td>
                                        <td>{{ $question->type }}</td>
                                        <td>
                                            
                                            <button onclick="document.location.href = '{{ route($mode . '.questions.edit', ['field' => $question->id]) }}'" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </button>

                                            <button onclick="remmoveModal('item', {{$question->id}}, '{{ route('api.' . $mode . '.question.destroy', ['field' => $question->id]) }}')" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop