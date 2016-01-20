'use strict';

var Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.http.options.root = '/root';
// Vue.http.headers.common['Authorization'] = '{{ Form::token() }}';
// $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
// Vue.http.headers.common[''] = '{{ Form::token() }}';
Vue.http.headers.common['csrftoken'] = document.querySelector('#token').getAttribute('value');

/*
 *	Vue Instance
 */
var testVue = new Vue ({
    el: '#testing_vue',

    data: {

        search:'',

        contacts: [
            {
                name: 'shawn',
                email: 'sprov03@david.com',
                phone: '979'
            },
            {
                name: 'dogman',
                email: 'wolfman@gmail.com',
                phone: '210'
            }
        ]
    },

    methods: {

        editClicked: function (index) {

            sendContactInfo(index,modalVue);
        },

        removeClicked: function(index) {

            var contact = this.contacts[index];
            deleteContactAjax(contact);
        }
    }
});



        //**************    AJAX REQUEST TO SERVER    ******************\\

// function test() {

    Vue.http.post('/testget' , null, function (data, status, request) {
        // tableVue.$data.contacts = data;

        console.log(data);
        testVue.$data.contacts[0]['name'] = 'david';
    }).catch(function (data, status, request) {
        alert("error");
    }); 
// }



function createNewContactAjax(obj) {

    Vue.http.post('/contacts', obj, function (data, status, request) {
        tableVue.$data.contacts.push(data);
    }).error(function (data, status, request) {
        alert("error");
    }); 
}

function updateContactAjax(obj) {

    Vue.http.put('/contacts/' + String(obj.id), obj, function (data, status, request) {
        
        saveChanges(data);
        // getContact(data);
    }).error(function (data, status, request) {
        alert("error");
    }); 
}

function deleteContactAjax(obj) {

    Vue.http.delete('/contacts/' + String(obj.id) , obj, function (data, status, request) {
        
        removeContact(data.id);
    }).error(function (data, status, request) {
        alert("error");
    });
}

function getContact(obj) {

    Vue.http.get('/contacts/' + String(obj.id) , null, function (data, status, request) {
        testVue.$data.contacts = data;
    }).error(function (data, status, request) {
        alert("error");
    }); 
}

function getContacts() {

    Vue.http.get('/contacts', null, function (data, status, request) {
        tableVue.$data.contacts = data;
    }).error(function (data, status, request) {
        alert("error");
    }); 
}