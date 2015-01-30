@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
@stop

{{-- Content --}}
@section('content')

<h4>{{trans('pages.actionedit')}} 
@if ($user->email == Sentry::getUser()->email)
	{{trans('users.yours')}}
@else 
	{{ $user->email }} 
@endif 
{{trans('pages.profile')}}</h4>
<div class="well">
	{{ Form::open(array(
        'action' => array('UserController@update', $user->id), 
        'method' => 'put',
        'class' => 'form-horizontal', 
        'role' => 'form'
        )) }}
        
        <div class="form-group {{ ($errors->has('firstName')) ? 'has-error' : '' }}" for="firstName">
            {{ Form::label('edit_firstName', trans('users.fname'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('firstName', $user->first_name, array('class' => 'form-control', 'placeholder' => trans('users.fname'), 'id' => 'edit_firstName'))}}
            </div>
            {{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}    			
    	</div>


        <div class="form-group {{ ($errors->has('lastName')) ? 'has-error' : '' }}" for="lastName">
            {{ Form::label('edit_lastName', trans('users.lname'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('lastName', $user->last_name, array('class' => 'form-control', 'placeholder' => trans('users.lname'), 'id' => 'edit_lastName'))}}
            </div>
            {{ ($errors->has('lastName') ? $errors->first('lastName') : '') }}                
        </div>

        <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}" for="title">
            {{ Form::label('edit_title', trans('users.title'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('title', $user->title, array('class' => 'form-control', 'placeholder' => trans('users.title'), 'id' => 'edit_title'))}}
            </div>
            {{ ($errors->has('title') ? $errors->first('title') : '') }}                
        </div>

        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}" for="phone">
            {{ Form::label('edit_phone', trans('users.phone'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('phone', $user->phone, array('class' => 'form-control', 'placeholder' => trans('users.phone'), 'id' => 'edit_phone'))}}
            </div>
            {{ ($errors->has('phone') ? $errors->first('phone') : '') }}                
        </div>

        <div class="form-group {{ ($errors->has('ext')) ? 'has-error' : '' }}" for="ext">
            {{ Form::label('edit_ext', trans('users.ext'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('ext', $user->ext, array('class' => 'form-control', 'placeholder' => trans('users.ext'), 'id' => 'edit_ext'))}}
            </div>
            {{ ($errors->has('ext') ? $errors->first('ext') : '') }}                
        </div>

        <div class="form-group {{ ($errors->has('fax')) ? 'has-error' : '' }}" for="fax">
            {{ Form::label('edit_fax', trans('users.fax'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('fax', $user->fax, array('class' => 'form-control', 'placeholder' => trans('users.fax'), 'id' => 'edit_fax'))}}
            </div>
            {{ ($errors->has('fax') ? $errors->first('fax') : '') }}                
        </div>


        <div class="form-group" for="colour">
            {{ Form::label('colour', trans('users.colour'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <select name="colour" id="colour-picker">
                    <option value="ffffff" {{$user->colour == 'ffffff' ? 'selected' : ''}}>#ffffff</option>
                    <option value="ffccc9" {{$user->colour == 'ffccc9' ? 'selected' : ''}}>#ffccc9</option>
                    <option value="ffce93" {{$user->colour == 'ffce93' ? 'selected' : ''}}>#ffce93</option>
                    <option value="fffc9e" {{$user->colour == 'fffc9e' ? 'selected' : ''}}>#fffc9e</option>
                    <option value="ffffc7" {{$user->colour == 'ffffc7' ? 'selected' : ''}}>#ffffc7</option>
                    <option value="9aff99" {{$user->colour == '9aff99' ? 'selected' : ''}}>#9aff99</option>
                    <option value="96fffb" {{$user->colour == '96fffb' ? 'selected' : ''}}>#96fffb</option>
                    <option value="cdffff" {{$user->colour == 'cdffff' ? 'selected' : ''}}>#cdffff</option>
                    <option value="cbcefb" {{$user->colour == 'cbcefb' ? 'selected' : ''}}>#cbcefb</option>
                    <option value="cfcfcf" {{$user->colour == 'cfcfcf' ? 'selected' : ''}}>#cfcfcf</option>
                    <option value="fd6864" {{$user->colour == 'fd6864' ? 'selected' : ''}}>#fd6864</option>
                    <option value="fe996b" {{$user->colour == 'fe996b' ? 'selected' : ''}}>#fe996b</option>
                    <option value="fffe65" {{$user->colour == 'fffe65' ? 'selected' : ''}}>#fffe65</option>
                    <option value="fcff2f" {{$user->colour == 'fcff2f' ? 'selected' : ''}}>#fcff2f</option>
                    <option value="67fd9a" {{$user->colour == '67fd9a' ? 'selected' : ''}}>#67fd9a</option>
                    <option value="38fff8" {{$user->colour == '38fff8' ? 'selected' : ''}}>#38fff8</option>
                    <option value="68fdff" {{$user->colour == '68fdff' ? 'selected' : ''}}>#68fdff</option>
                    <option value="9698ed" {{$user->colour == '9698ed' ? 'selected' : ''}}>#9698ed</option>
                    <option value="c0c0c0" {{$user->colour == 'c0c0c0' ? 'selected' : ''}}>#c0c0c0</option>
                    <option value="fe0000" {{$user->colour == 'fe0000' ? 'selected' : ''}}>#fe0000</option>
                    <option value="f8a102" {{$user->colour == 'f8a102' ? 'selected' : ''}}>#f8a102</option>
                    <option value="ffcc67" {{$user->colour == 'ffcc67' ? 'selected' : ''}}>#ffcc67</option>
                    <option value="f8ff00" {{$user->colour == 'f8ff00' ? 'selected' : ''}}>#f8ff00</option>
                    <option value="34ff34" {{$user->colour == '34ff34' ? 'selected' : ''}}>#34ff34</option>
                    <option value="68cbd0" {{$user->colour == '68cbd0' ? 'selected' : ''}}>#68cbd0</option>
                    <option value="34cdf9" {{$user->colour == '34cdf9' ? 'selected' : ''}}>#34cdf9</option>
                    <option value="6665cd" {{$user->colour == '6665cd' ? 'selected' : ''}}>#6665cd</option>
                    <option value="9b9b9b" {{$user->colour == '9b9b9b' ? 'selected' : ''}}>#9b9b9b</option>
                    <option value="cb0000" {{$user->colour == 'cb0000' ? 'selected' : ''}}>#cb0000</option>
                    <option value="f56b00" {{$user->colour == 'f56b00' ? 'selected' : ''}}>#f56b00</option>
                    <option value="ffcb2f" {{$user->colour == 'ffcb2f' ? 'selected' : ''}}>#ffcb2f</option>
                    <option value="ffc702" {{$user->colour == 'ffc702' ? 'selected' : ''}}>#ffc702</option>
                    <option value="32cb00" {{$user->colour == '32cb00' ? 'selected' : ''}}>#32cb00</option>
                    <option value="00d2cb" {{$user->colour == '00d2cb' ? 'selected' : ''}}>#00d2cb</option>
                    <option value="3166ff" {{$user->colour == '3166ff' ? 'selected' : ''}}>#3166ff</option>
                    <option value="6434fc" {{$user->colour == '6434fc' ? 'selected' : ''}}>#6434fc</option>
                    <option value="656565" {{$user->colour == '656565' ? 'selected' : ''}}>#656565</option>
                    <option value="9a0000" {{$user->colour == '9a0000' ? 'selected' : ''}}>#9a0000</option>
                    <option value="ce6301" {{$user->colour == 'ce6301' ? 'selected' : ''}}>#ce6301</option>
                    <option value="cd9934" {{$user->colour == 'cd9934' ? 'selected' : ''}}>#cd9934</option>
                    <option value="999903" {{$user->colour == '999903' ? 'selected' : ''}}>#999903</option>
                    <option value="009901" {{$user->colour == '009901' ? 'selected' : ''}}>#009901</option>
                    <option value="329a9d" {{$user->colour == '329a9d' ? 'selected' : ''}}>#329a9d</option>
                    <option value="3531ff" {{$user->colour == '3531ff' ? 'selected' : ''}}>#3531ff</option>
                    <option value="6200c9" {{$user->colour == '6200c9' ? 'selected' : ''}}>#6200c9</option>
                    <option value="343434" {{$user->colour == '343434' ? 'selected' : ''}}>#343434</option>
                    <option value="680100" {{$user->colour == '680100' ? 'selected' : ''}}>#680100</option>
                    <option value="963400" {{$user->colour == '963400' ? 'selected' : ''}}>#963400</option>
                    <option value="986536" {{$user->colour == '986536' ? 'selected' : ''}}>#986536</option>
                    <option value="646809" {{$user->colour == '646809' ? 'selected' : ''}}>#646809</option>
                    <option value="036400" {{$user->colour == '036400' ? 'selected' : ''}}>#036400</option>
                    <option value="34696d" {{$user->colour == '34696d' ? 'selected' : ''}}>#34696d</option>
                    <option value="00009b" {{$user->colour == '00009b' ? 'selected' : ''}}>#00009b</option>
                    <option value="303498" {{$user->colour == '303498' ? 'selected' : ''}}>#303498</option>
                    <option value="000000" {{$user->colour == '000000' ? 'selected' : ''}}>#000000</option>
                    <option value="330001" {{$user->colour == '330001' ? 'selected' : ''}}>#330001</option>
                    <option value="643403" {{$user->colour == '643403' ? 'selected' : ''}}>#643403</option>
                    <option value="663234" {{$user->colour == '663234' ? 'selected' : ''}}>#663234</option>
                    <option value="343300" {{$user->colour == '343300' ? 'selected' : ''}}>#343300</option>
                    <option value="013300" {{$user->colour == '013300' ? 'selected' : ''}}>#013300</option>
                    <option value="003532" {{$user->colour == '003532' ? 'selected' : ''}}>#003532</option>
                    <option value="010066" {{$user->colour == '010066' ? 'selected' : ''}}>#010066</option>
                    <option value="340096" {{$user->colour == '340096' ? 'selected' : ''}}>#340096</option>
                </select>       
            </div>       
        </div>


        @if (Sentry::check() && (Sentry::getUser()->hasAccess('Super Admin') || Sentry::getUser()->hasAccess('Admin')))
        <div class="form-group">
            {{ Form::label('edit_memberships', trans('users.group_membership'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                @foreach ($allGroups as $group)
                    @if ($group->name == "Super Admin" && !Sentry::getUser()->hasAccess('Super Admin'))

                    @else
                    <label class="radio-inline">
                      <input type="radio" name="group" {{($user->groups()->first()->id == $group->id) ? "checked" : ""}} value="{{$group->id}}">
                      @if ($group->name == "Super Admin")
                            Admin Level 1
                        @elseif ($group->name == "Admin")
                            Admin Level 2
                        @else
                            {{$group->name}}
                        @endif
                    </label>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::hidden('id', $user->id) }}
                {{ Form::submit('Save', array('class' => 'btn btn-primary'))}}
            </div>
      </div>
    {{ Form::close()}}
</div>

<h4>{{trans('users.change_passwort')}}</h4>
<div class="well">
    {{ Form::open(array(
        'action' => array('UserController@change', $user->id), 
        'class' => 'form-inline', 
        'role' => 'form'
        )) }}

        <div class="form-group {{ $errors->has('newPassword') ? 'has-error' : '' }}">
        	{{ Form::label('newPassword', trans('users.newpassword_lbl'), array('class' => 'sr-only')) }}
            {{ Form::password('newPassword', array('class' => 'form-control', 'placeholder' => trans('users.newpassword_lbl'))) }}
    	</div>

    	<div class="form-group {{ $errors->has('newPassword_confirmation') ? 'has-error' : '' }}">
        	{{ Form::label('newPassword_confirmation', trans('users.newcompassword_lbl'), array('class' => 'sr-only')) }}
            {{ Form::password('newPassword_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.newcompassword_lbl'))) }}
    	</div>

        {{ Form::submit(trans('users.change_passwort'), array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px'))}}
	        	
      {{ ($errors->has('newPassword') ?  '<br />' . $errors->first('newPassword') : '') }}
      {{ ($errors->has('newPassword_confirmation') ? '<br />' . $errors->first('newPassword_confirmation') : '') }}

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
    });
  })(jQuery);
  </script>
@stop
