@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
@stop

{{-- Content --}}
@section('content')

<h4>{{trans('pages.register_new')}}</h4>
<div class="well">
    {{ Form::open(array('action' => 'UserController@signup', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}

    <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}" for="email">
        {{ Form::label('edit_email', trans('users.email'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'), 'id' => 'edit_email'))}}
        </div>
        {{ ($errors->has('email') ? $errors->first('email') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}" for="password">
        {{ Form::label('edit_password', trans('users.password'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users.password'), 'id' => 'edit_password'))}}
        </div>
        {{ ($errors->has('password') ? $errors->first('password') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}" for="password_confirmation">
        {{ Form::label('edit_password_confirmation', trans('users.pw_confirm'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.pw_confirm'), 'id' => 'edit_password_confirmation'))}}
        </div>
        {{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('firstName')) ? 'has-error' : '' }}" for="firstName">
        {{ Form::label('edit_firstName', trans('users.fname'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::text('firstName', null, array('class' => 'form-control', 'placeholder' => trans('users.fname'), 'id' => 'edit_firstName'))}}
        </div>
        {{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}                
    </div>


    <div class="form-group {{ ($errors->has('lastName')) ? 'has-error' : '' }}" for="lastName">
        {{ Form::label('edit_lastName', trans('users.lname'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::text('lastName', null, array('class' => 'form-control', 'placeholder' => trans('users.lname'), 'id' => 'edit_lastName'))}}
        </div>
        {{ ($errors->has('lastName') ? $errors->first('lastName') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}" for="title">
        {{ Form::label('edit_title', trans('users.title'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => trans('users.title'), 'id' => 'edit_title'))}}
        </div>
        {{ ($errors->has('title') ? $errors->first('title') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}" for="phone">
        {{ Form::label('edit_phone', trans('users.phone'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder' => trans('users.phone'), 'id' => 'edit_phone'))}}
        </div>
        {{ ($errors->has('phone') ? $errors->first('phone') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('ext')) ? 'has-error' : '' }}" for="ext">
        {{ Form::label('edit_ext', trans('users.ext'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('ext', null, array('class' => 'form-control', 'placeholder' => trans('users.ext'), 'id' => 'edit_ext'))}}
        </div>
        {{ ($errors->has('ext') ? $errors->first('ext') : '') }}                
    </div>

    <div class="form-group {{ ($errors->has('fax')) ? 'has-error' : '' }}" for="fax">
        {{ Form::label('edit_fax', trans('users.fax'), array('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-10">
            {{ Form::text('fax', null, array('class' => 'form-control', 'placeholder' => trans('users.fax'), 'id' => 'edit_fax'))}}
        </div>
        {{ ($errors->has('fax') ? $errors->first('fax') : '') }}                
    </div>


    <div class="form-group" for="colour">
        {{ Form::label('colour', trans('users.colour'), array('class' => 'col-sm-2 control-label req-field')) }}
        <div class="col-sm-10">
            <select name="colour" id="colour-picker">
                <option value="ffffff">#ffffff</option>
                <option value="ffccc9">#ffccc9</option>
                <option value="ffce93">#ffce93</option>
                <option value="fffc9e">#fffc9e</option>
                <option value="ffffc7">#ffffc7</option>
                <option value="9aff99">#9aff99</option>
                <option value="96fffb">#96fffb</option>
                <option value="cdffff">#cdffff</option>
                <option value="cbcefb">#cbcefb</option>
                <option value="cfcfcf">#cfcfcf</option>
                <option value="fd6864">#fd6864</option>
                <option value="fe996b">#fe996b</option>
                <option value="fffe65">#fffe65</option>
                <option value="fcff2f">#fcff2f</option>
                <option value="67fd9a">#67fd9a</option>
                <option value="38fff8">#38fff8</option>
                <option value="68fdff">#68fdff</option>
                <option value="9698ed">#9698ed</option>
                <option value="c0c0c0">#c0c0c0</option>
                <option value="fe0000">#fe0000</option>
                <option value="f8a102">#f8a102</option>
                <option value="ffcc67">#ffcc67</option>
                <option value="f8ff00">#f8ff00</option>
                <option value="34ff34">#34ff34</option>
                <option value="68cbd0">#68cbd0</option>
                <option value="34cdf9">#34cdf9</option>
                <option value="6665cd">#6665cd</option>
                <option value="9b9b9b">#9b9b9b</option>
                <option value="cb0000">#cb0000</option>
                <option value="f56b00">#f56b00</option>
                <option value="ffcb2f">#ffcb2f</option>
                <option value="ffc702">#ffc702</option>
                <option value="32cb00">#32cb00</option>
                <option value="00d2cb">#00d2cb</option>
                <option value="3166ff">#3166ff</option>
                <option value="6434fc">#6434fc</option>
                <option value="656565">#656565</option>
                <option value="9a0000">#9a0000</option>
                <option value="ce6301">#ce6301</option>
                <option value="cd9934">#cd9934</option>
                <option value="999903">#999903</option>
                <option value="009901">#009901</option>
                <option value="329a9d">#329a9d</option>
                <option value="3531ff">#3531ff</option>
                <option value="6200c9">#6200c9</option>
                <option value="343434">#343434</option>
                <option value="680100">#680100</option>
                <option value="963400">#963400</option>
                <option value="986536">#986536</option>
                <option value="646809">#646809</option>
                <option value="036400">#036400</option>
                <option value="34696d">#34696d</option>
                <option value="00009b">#00009b</option>
                <option value="303498">#303498</option>
                <option value="000000">#000000</option>
                <option value="330001">#330001</option>
                <option value="643403">#643403</option>
                <option value="663234">#663234</option>
                <option value="343300">#343300</option>
                <option value="013300">#013300</option>
                <option value="003532">#003532</option>
                <option value="010066">#010066</option>
                <option value="340096">#340096</option>
            </select>       
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('edit_memberships', trans('users.group_membership'), array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-10">
            @foreach ($allGroups as $group)
                <label class="radio-inline">
                    <input type="radio" name="group" value="{{$group->id}}" checked="checked">
                    @if ($group->name == "Super Admin")
                        Admin Level 1
                    @elseif ($group->name == "Admin")
                        Admin Level 2
                    @else
                        {{$group->name}}
                    @endif
                </label>
            @endforeach
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
        </div>
    </div>

    {{ Form::close() }}
</div>

@stop

{{-- Javascript --}}
@section('javascript')
  <script type="text/javascript">
  (function($) {
    users = Array();
    $(document).ready(function() {
        jQuery('#colour-picker').colourPicker({
            ico:   '{{asset('/img/colourwheel.gif')}}', 
            title:    false
        });

        $('.req-field').each(function() {
            $(this).append("<span style='color:red'> *</span>");
        });
    });
  })(jQuery);

  </script>
@stop
