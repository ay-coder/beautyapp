<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Product Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('company_name', 'company_name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('product_type', 'product_type :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Product Type', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('product_type', 'Product Sub Type :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('product_sub_type', null, ['class' => 'form-control', 'placeholder' => 'Product Sub Type', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('product_code', 'Product Code :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Product Code']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('barcode', 'Barcode :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => 'Barcode']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('manufacturer_sku', 'Manufacturer SKU :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('manufacturer_sku', null, ['class' => 'form-control', 'placeholder' => 'Manufacturer SKU']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('retailer_sku', 'Retailer SKU :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('retailer_sku', null, ['class' => 'form-control', 'placeholder' => 'Retailer SKU']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('ingredients', 'Choose Ingredients :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('ingredients[]', $ingredientRepository->getSelectOptions('id', 'title'),
                     isset($item) ? $item->ingredients->pluck('id') : [], ['class' => 'form-control', 'multiple' => 'multiple', 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('description', 'Description :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['rows' => 4, 'cols' => 40, 'class' => 'form-control']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('image', 'Select Image :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image))
            {{ Html::image('/uploads/product/'.$item->image, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image1', 'Select Image1 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image1', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image1))
            {{ Html::image('/uploads/product/'.$item->image1, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image2', 'Select Image2 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image2', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image2))
            {{ Html::image('/uploads/product/'.$item->image2, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image3', 'Select Image3 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image3', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image3))
            {{ Html::image('/uploads/product/'.$item->image3, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>