Vue.component('form-livros',{
    props:['livro'],
    data:{ 
    },
    methods:{
      salvar:function(){
        console.log(this.livro);
        this.$emit('salvar',{livro:this.livro});      
        this.limpar();
      },
      limpar:function(){
        console.log(this.livro);
        this.livro={};
      }
    },
    template: '\
    <form>\
        <div class="form-group">\
            <label class="text" for="isbn">ISBN</label>\
            <input class="form-control" id="isbn" v-model="livro.isbn"><br>\
            \
            <label class="text" for="nome">Nome</label>\
            <input class="form-control" id="nome" v-model="livro.nome"><br>\
        </div>\
        <div class="form-group">\
            <label class="text" for="autor">Autor</label>\
            <input class="form-control" id="autor" v-model="livro.autor"><br>\
            \
            <label class="text" for="editora">Editora</label>\
            <input class="form-control" id="editora" v-model="livro.editora"><br>\
        </div>\
        <div class="form-group">\
            <label class="text" for="ano">Ano</label>\
            <input class="form-control" id="ano" v-model="livro.ano"><br>\
        </div>\
        \
        <div class="form-group">\
        <button type="button" class="btn adicionar" v-on:click="salvar()">Adicionar Livro</button>\
        <button type="button" class="btn limpar" v-on:click="limpar()">Limpar</button>\
        </div>\
    </form>'
});

Vue.component('tabela-livro',{
    props:['lista'],
    data:{
    },
    methods: {
    },
    template: '\
    <table class="table">\
        <thead>\
            <tr>\
                <th scope="col">ID</th>\
                <th scope="col">ISBN</th>\
                <th scope="col">Nome</th>\
                <th scope="col">Autor</th>\
                <th scope="col">Editora</th>\
                <th scope="col">Ano</th>\
            </tr>\
        </thead>\
        <tbody>\
        <tr v-for="item of lista">\
            <td>{{item.id}}</td>\
            <td>{{item.isbn}}</td>\
            <td>{{item.nome}}</td>\
            <td>{{item.autor}}</td>\
            <td>{{item.editora}}</td>\
            <td>{{item.ano}}</td>\
        </tr>\
    </table>'
});

Vue.component('tabela-livros',{
    props:['lista'],
    data:{
    },
    methods: {
        deletar:function(item){
            console.log(item);
            this.$emit('deletar', {item:item});      
        },
        editar:function(item){
            console.log(item);
            this.$emit('editar', {item:item});
        }
    },
    template: '\
      <div class="cards-livros mt-4">\
        <div class="card-body" v-for="item of lista ">\
          <h5 class="card-title">{{item.nome}}</h5>\
          <p class="card-text">ISBN: {{item.isbn}}</p>\
          <p class="card-text">Autor: {{item.autor}}</p>\
          <p class="card-text">Editora: {{item.editora}}</p>\
          <p class="card-text">Ano: {{item.ano}}</p>\
          <button type="button" class="btn deletar mr-2" v-on:click="deletar(item)">Deletar Livro</button>\
          <button type="button" class="btn editar" v-on:click="editar(item)">Editar Livro</button>\
        </div>\
    </div>\
    '
});

Vue.component('topo',{
    data:{ 
    },
    template: '\
    <nav class="navbar navbar-expand-lg navbar-light">\
  <a class="navbar-brand logo" href="#">Biblioteca</a>\
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">\
    <span class="navbar-toggler-icon"></span>\
  </button>\
    \
  <div class="collapse navbar-collapse" id="navbarSupportedContent">\
    <ul class="navbar-nav mr-auto">\
      <li class="nav-item">\
        <a class="nav-link">Endereço</a>\
     </li>\
      <li class="nav-item">\
        <a class="nav-link">Cadastrar Livros</a>\
      </li>\
      <li class="nav-item">\
        <a class="nav-link">Livros</a>\
      </li>\
    </ul>\
  </div>\
</nav>'
});


