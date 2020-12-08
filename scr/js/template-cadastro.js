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

Vue.component('tabela-livros',{
    props:['lista'],
    data:{
    },
    methods: {
        deletar:function(item){
            console.log(item);
            this.$emit('deletar', {item:item});      
        },
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
            <button type="button" class="btn deletar" v-on:click="deletar(item)">Deletar Livro</button>\
            <button type="button" class="btn editar" v-on:click="editar(item)">Editar Livro</button>\
        </tr>\
    </table>'
});
