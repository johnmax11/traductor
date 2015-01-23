@extends('admin.template.master')
@section ('content')
{{ HTML::script('js/admin/settings/account.js'); }}
<content>
    <div>
        <table>
            <tr>
                <th>
                    @include('admin.settings.template.menu')
                </th>
                <th>
                    <div>
                        <h1>Account Data</h1>
                        {{ Form::open(array('id'=>'frmAccount','url' => 'admin/settings/account/save', 'method' => 'POST')) }}
                        <div>
                            <fieldset>
                                <legend>Data Login</legend>
                                <div>
                                    {{ Form::label('lblEmail', 'E-mail') }}
                                    {{ Form::text('txtEmail', null, array('class' => 'form-control validate','disabled'=>'disabled','id'=>'txtEmail')) }}
                                </div>
                                <div>
                                    {{ Form::label('chkResetPassword', 'Reset Password') }}
                                    {{ Form::checkbox('chkResetPassword',null,false, array('class' => 'form-control','id'=>'chkResetPassword')) }}
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Data Basics</legend>
                                <div>
                                    {{ Form::label('lblFirst_name', 'First Name *') }}
                                    {{ Form::text('txtFirst_name', null, array('class' => 'form-control validate','id'=>'txtFirst_name')) }}        
                                    {{ Form::label('lblMiddle_name', 'Middle Name') }}
                                    {{ Form::text('txtMiddle_name', null, array('class' => 'form-control','id'=>'txtMiddle_name')) }}        
                                </div>
                                <div>
                                    {{ Form::label('lblLast_name', 'Last Name *') }}
                                    {{ Form::text('txtLast_name', null, array('class' => 'form-control validate','id'=>'txtLast_name')) }}        
                                    {{ Form::label('lblLast_middle_name', 'Last Middle Name') }}
                                    {{ Form::text('txtLast_middle_name', null, array('class' => 'form-control','id'=>'txtLast_middle_name')) }}        
                                </div>
                                <div>
                                    {{ Form::label('lblStatus_user', 'Status User') }}
                                    {{ Form::select('txtStatus_user', array('Y'=>'Active','N'=>'Inactive'),null, array('class' => 'form-control','id'=>'txtStatus_user','disabled'=>'disabled')) }}
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Communication</legend>
                                <div>
                                    {{ Form::label('lblEmail_1', 'E-mail 1') }}
                                    {{ Form::email('txtEmail_1', null, array('class' => 'form-control validate','id'=>'txtEmail_1','disabled'=>'disabled')) }}
                                    {{ Form::label('lblEmail_2', 'E-mail 2') }}
                                    {{ Form::email('txtEmail_2', null, array('class' => 'form-control','id'=>'txtEmail_2')) }}
                                </div>
                                <div>
                                    {{ Form::label('lblPhone_1', 'Phone 1') }}
                                    {{ Form::text('txtPhone_1', null, array('class' => 'form-control','id'=>'txtPhone_1')) }}
                                    {{ Form::label('lblPhone_2', 'Phone 2') }}
                                    {{ Form::text('txtPhone_2', null, array('class' => 'form-control','id'=>'txtPhone_2')) }}
                                </div>
                                <div>
                                    {{ Form::label('lblPhoneMobile_1', 'Phone Mobile 1') }}
                                    {{ Form::text('txtPhoneMobile_1', null, array('class' => 'form-control','id'=>'txtPhoneMobile_1')) }}
                                    {{ Form::label('lblPhoneMobile_2', 'Phone Mobile 2') }}
                                    {{ Form::text('txtPhoneMobile_2', null, array('class' => 'form-control','id'=>'txtPhoneMobile_2')) }}
                                </div>
                            </fieldset>
                        </div>
                        {{ Form::button('Save Data', array('id'=>'bttnSubmit','type' => 'button', 'class' => 'btn btn-primary')) }}    

                      {{ Form::close() }}
                    </div>
                </th>
            </tr>
        </table>
    </div>
</content>
@stop