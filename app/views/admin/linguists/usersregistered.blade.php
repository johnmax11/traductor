@extends('admin.template.master')
@section ('content')
{{ HTML::script('js/admin/linguists/usersregistered.js'); }}
<content>
    <div>
        <table>
            <tr>
                <th>
                    @include('admin.linguists.template.menu')
                </th>
                <th>
                    <div>
                        <h1>Users</h1>
                        <div id="divStateError"></div>
                        <div id="divTabs">
                            <ul>
                                <li><a href="#tab1">Translator</a></li>
                                <li><a href="#tab2">Clients</a></li>
                                <li><a href="#tab3">Administrator</a></li>
                            </ul>
                            <div id="tab1">
                                <div id="divFiltros_trans"></div>
                                <table id='griddatoscx_trans'></table>
                                <div id='pagerdatoscx_trans'></div>
                            </div>
                            <div id="tab2">
                                <div id="divFiltros_clien"></div>
                                <table id='griddatoscx_clien'></table>
                                <div id='pagerdatoscx_clien'></div>
                            </div>
                            <div id="tab3">
                                <div id="divFiltros_admin"></div>
                                <table id='griddatoscx_admin'></table>
                                <div id='pagerdatoscx_admin'></div>
                            </div>
                        </div>
                    </div>
                </th>
            </tr>
        </table>
    </div>
</content>
@stop