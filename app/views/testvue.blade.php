@extends('layouts.master')

@section('top-script')
<meta id="token" name="token" value="{{ csrf_token() }}">
<style type="text/css">

</style>

@stop


@section('content')

    <h1>test</h1>

    <div class="col-sm-12" id="testing_vue">
        <table class="table table-striped" >

            <thead>
                <tr>
                    <td class="col-sm-2">Name</td>
                    <td class="col-sm-3">Email</td>
                    <td class="col-sm-3">Phone</td>
                    <td class="col-sm-4">Actions</td>
                </tr>
            </thead>

            <tbody >

                <tr v-for="contact in contacts | filterBy search" v-on:click="processSource">

                    <td>
                        @{{contact.name}}
                    </td>

                    <td>
                        @{{contact.email}}
                    </td>

                    <td>
                        @{{contact.phone}}
                    </td>

                    <td>

                        <button class="edit btn btn-default btn-sm" data-contact-id="@{{contact.contactId}}" data-toggle="modal" data-target="#myModal">edit</button>

                        <button class="remove btn btn-danger" data-contact-id="@{{contact.contactId}}">remove</button>

                    </td>

                </tr>

            </tbody>
        </table>
    </div>

@stop

@section('bottom-script')

    <script src="/js/testbundle.js"></script>

@stop