<div class="row">
    <div class="form-group col-md-12 {!! ($errors->has('office_name') ? 'has-error' : '') !!}">
        {!! Form::label('office_name','Name of Office', ['class' => 'control-label']) !!}
        {!! Form::text('office_name', null, ['id'=>'Officename','class' => 'form-control capital' . ($errors->has('office_name') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('office_name', '<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12 {!! ($errors->has('address') ? 'has-error' : '') !!}">
        {!! Form::label('address','Address', ['class' => 'control-label']) !!}
        {!! Form::text('address', null, ['id'=>'Address','class' => 'form-control capital' . ($errors->has('address') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 {!! ($errors->has('city') ? 'has-error' : '') !!}">
        {!! Form::label('city','City', ['class' => 'control-label']) !!}
        {!! Form::text('city', null, ['id'=>'city','class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
    </div>

    @if(@$offices->state)
    <div class="form-group col-md-3 {!! ($errors->has('state') ? 'has-error' : '') !!}">

        {!! Form::label('state','Select state', ['class' => 'control-label']) !!}
        {!! Form::select('state',$states, $offices->state , ['class' => 'form-control' . ($errors->has('state') ? ' is-invalid' : '')]) !!}
        {!! $errors->first('state', '<span class="help-block">:message</span>') !!}

    </div>

    @else
    <div class="form-group col-md-3 {!! ($errors->has('state') ? 'has-error' : '') !!}">

        {!! Form::label('state','Select state', ['class' => 'control-label']) !!}
        {!! Form::select('state',$states,null, ['placeholder' => 'Select State', 'class' => 'form-control' . ($errors->has('state') ? ' is-invalid' : '')]) !!}
        {!! $errors->first('state', '<span class="help-block">:message</span>') !!}

    </div>

    @endif


    <div class="form-group col-md-3 {!! ($errors->has('zip_code') ? 'has-error' : '') !!}">
        {!! Form::label('zip_code','Zip Code', ['class' => 'control-label']) !!}
        {!! Form::text('zip_code', null, ['id'=>'zip-code','maxlength' =>'5','class' => 'form-control' . ($errors->has('zip_code') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('zip_code', '<span class="help-block">:message</span>') !!}
    </div>

</div>
<script>
 
</script>