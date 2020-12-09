var app = new Vue({
    el: '#cadastro-livros',
    data: {
        novoLivro: {},
        livros:[],
    },
    methods:{
        addLivro: function(){
            axios
                .post('/api/livros', this.novoLivro)
                .then(response => {
                    this.refresh();
                    this.novoLivro={};
                })
        },
        refresh: function(){
            axios
                .get('/api/livros')
                .then(response=>{
                this.livros = response.data;
                console.log("Response: ",response) 
                })
        },
    },
    
    created: function(){
        console.log("Iniciando...")
        this.refresh();
    }
});

var app2 = new Vue({
    el: '#livros',
    data: {
        novoLivro: {},
        livros:[],
    },
    methods:{
        refresh: function(){
            axios
                .get('/api/livros')
                .then(response=>{
                this.livros = response.data;
                console.log("Response: ",response) 
                })
        },
        dtLivro:function(item){
            axios
                .delete('/api/livros/' + item.item.id)
                .then(response => {
                    this.livros.splice(item.item.id, 1)
                    console.log(item.item.id);
                    console.log("Response: ",response)
                    this.sucesso = 'Registro apagado com sucesso'
                    this.refresh();
                });
        },
        editarLivro:function(item){
            axios
                .put('/api/livros/' + item.item.id)
                .then(response => {
                    this.livros.splice(item.item.id, 1)
                    console.log(item.item.id);
                    console.log("Response: ",response)
                    this.sucesso = 'Registro editado com sucesso'
                    this.refresh();
            });
        } 
    },
    
    created: function(){
        console.log("Iniciando...")
        this.refresh();
    }
});
