/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


//Formulario Dinamico

//Código HTML - formulario por tipo de funcao

var funcPergunta = 
    '<tr>'
        '<td>'
        '<div class="form-control"> Pergunta </div>'
        '<td>'
            '<input type="text" name="nome_fun[]" value="nome_func" placeholder="Nome da funcao" class="form-control">'
        '</td>'
        '<td>'
            '<input disabled type="text" name="ouvir[]" value="ouvir" placeholder="Palavra para iniciar funcao" class="form-control">'
        '</td>'
        '<td>'
            '<select name="validacao" id="" class="form-control form-select-sm">'
                '<option value="">Não validar</option>'
                '<option value="">CPF</option>'
                '<option value="">Email</option>' 
                '<option value="">Celular</option>'
            '</select>'
        '</td>'
        '<td>'
            '<input type="text" name="pergunta[]" value="pergunta" placeholder="Texto pergunta" class="form-control">'
        '</td>'
        '<td>'
            '<input type="text" name="resposta[]" value="resposta" placeholder="Texto resposta" class="form-control">'
        '</td>'
        '<td>'
            '<input type="text" name="nome_prox[]" value="nome_prox" placeholder="Nome da proxima funcao" class="form-control">'
        '</td>'
        '<td >'
            '<input disabled type="file" name="arquivo[]" value="arquivo" placeholder="Arquivo para enviar" class="form-control p-1">'
        '</td>'
    '</tr>';

    var func_pergunta_iniciar_conversa = 
    '<tr>'
        '<td>'
        '<div class="form-control"> Pergunta </div>'
        '<td>'
            '<input type="text" name="nome_fun[]" value="nome_func" placeholder="Nome da funcao" class="form-control">'
        '</td>'
        '<td>'
            '<input disabled type="text" name="ouvir[]" value="ouvir" placeholder="Palavra para iniciar funcao" class="form-control">'
        '</td>'
        '<td>'
            '<select name="validacao" id="" class="form-control form-select-sm">'
                '<option value="">Não validar</option>'
                '<option value="">CPF</option>'
                '<option value="">Email</option>' 
                '<option value="">Celular</option>'
            '</select>'
        '</td>'
        '<td>'
            '<input type="text" name="pergunta[]" value="pergunta" placeholder="Texto pergunta" class="form-control">'
        '</td>'
        '<td>'
            '<input type="text" name="resposta[]" value="resposta" placeholder="Texto resposta" class="form-control">'
        '</td>'
        '<td>'
            '<input type="text" name="nome_prox[]" value="nome_prox" placeholder="Nome da proxima funcao" class="form-control">'
        '</td>'
        '<td >'
            '<input  disabled  type="file" name="arquivo[]" value="arquivo" placeholder="Arquivo para enviar" class="form-control p-1">'
        '</td>'
    '</tr>';

