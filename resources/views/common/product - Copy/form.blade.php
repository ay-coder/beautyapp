<div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Ingredient Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingredient Name ', 'required' => 'required']) }}
        </div>
    </div>
</div>