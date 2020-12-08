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
        dtLidvro:function(item){
            axios
                .delete('/api/livros/' + item.item.id)
                .then(response => {
                    this.livros.splice(item.item.id, 1)
                    console.log(item.item.id);
                    console.log("Response: ",response)
                    this.sucesso = 'Registro apagado com sucesso'
                });
        }   
    },
    
    created: function(){
        console.log("Iniciando...")
        this.refresh();
    }
});
