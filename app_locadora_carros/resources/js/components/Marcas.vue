<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- INICIO CARD BUSCA -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <input-container-component
                                        titulo="ID"
                                        id="inputId"
                                        id-help="idHelp"
                                        texto-ajuda="Opcional. Informe o ID da marca">
                                            <input v-model="busca.id" type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                    </input-container-component>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <input-container-component
                                        titulo="Nome da marca"
                                        id="inputNome"
                                        id-help="nomeHelp"
                                        texto-ajuda="Opcional. Informe o nome da marca">
                                            <input v-model="busca.nome" type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome">
                                    </input-container-component>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary" @click="pesquisar()">Buscar</button>
                        </div>
                    </template>
                </card-component>
                <!-- FIM CARD BUSCA -->
                <!-- INICIO CARD RELACAO DE MARCAS -->
                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <table-component
                            :dados="marcas.data"
                            :visualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaVisualizar'}"
                            :atualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaAtualizar'}"
                            :remover="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaRemover'}"
                            :titulos="{
                                id:{titulo: 'ID', tipo: 'texto'},
                                nome: {titulo: 'Nome', tipo: 'texto'},
                                imagem: {titulo: 'Imagem', tipo: 'imagem'},
                                created_at: {titulo: 'Data de criação', tipo: 'data'},
                            }"
                        >
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links" :key="key" :class="l.active ? 'page-item active' : 'page-item'" @click="paginacao(l)">
                                        <a class="page-link" v-html="l.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-sm float-end btn-primary" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- FIM CARD RELACAO DE MARCAS -->
            </div>
        </div>
        <!-- INICIO MODAL ADICIONAR MARCA -->
        <modal-component id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:alertas>
                <alert-component v-if="transacaoStatus == 'Adicionado'" tipo="success"></alert-component>
                <alert-component v-if="transacaoStatus == 'Erro'" tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a marca"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component
                        titulo="Nome da marca"
                        id="novoNome"
                        id-help="novoNomeHelp"
                        texto-ajuda="Informe o nome da marca">
                            <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="nomeMarca">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component
                        titulo="Logo da marca"
                        id="inputLogo"
                        id-help="logoHelp"
                        texto-ajuda="Selecione o logo da marca">
                            <input type="file" class="form-control" id="inputLogo" aria-describedby="logoHelp" placeholder="Logo da marca" @change="carregarImagem($event)">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="cadastrarMarca()">Salvar</button>
            </template>
        </modal-component>
        <!-- FIM MODAL ADICIONAR MARCA -->
        <!-- INICIO MODAL VISUALIZAR MARCA -->
        <modal-component id="modalMarcaVisualizar" titulo="Visualizar Marca">
            <template v-slot:alertas>
            </template>
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                        <input type="text" class="form-control" disabled v-model="$store.state.item.id">
                </input-container-component>
                <input-container-component titulo="Nome da Marca">
                        <input type="text" class="form-control" disabled v-model="$store.state.item.nome">
                </input-container-component>
                <input-container-component titulo="Imagem">
                        <img :src="$store.state.item.imagem" alt="Imagem da marca" class="img-fluid" v-if="$store.state.item.imagem">
                </input-container-component>
                <input-container-component titulo="Data de Criação">
                        <input type="text" class="form-control" disabled v-model="$store.state.item.created_at">
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!-- FIM MODAL VISUALIZAR MARCA -->
        <!-- INICIO MODAL REMOÇÃO MARCA -->
        <modal-component id="modalMarcaRemover" titulo="Remover Marca">
            <template v-slot:alertas>
                <alert-component v-if="$store.state.transacao.status == 'Sucesso'" tipo="success" :titulo="$store.state.transacao.mensagem" :detalhes="{data: { message: ''}}"></alert-component>
                <alert-component v-if="$store.state.transacao.status == 'Erro'" tipo="danger" :titulo="$store.state.transacao.mensagem" :detalhes="{data: { message: ''}}"></alert-component>
            </template>
            <template v-slot:conteudo v-if="$store.state.transacao.status != 'Sucesso'">
                <input-container-component titulo="ID">
                        <input type="text" class="form-control" disabled v-model="$store.state.item.id">
                </input-container-component>
                <input-container-component titulo="Nome da Marca">
                        <input type="text" class="form-control" disabled v-model="$store.state.item.nome">
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status != 'Sucesso'">Remover</button>
            </template>
        </modal-component>
        <!-- FIM MODAL REMOÇÃO MARCA -->
        <!-- INICIO MODAL ATUALIZAR MARCA -->
        <modal-component id="modalMarcaAtualizar" titulo="Atualizar Marca">
            <template v-slot:alertas>
                <alert-component v-if="transacaoStatus == 'Adicionado'" tipo="success"></alert-component>
                <alert-component v-if="transacaoStatus == 'Erro'" tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a marca"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component
                        titulo="Nome da marca"
                        id="atualizarNome"
                        id-help="atualizaNomeHelp"
                        texto-ajuda="Informe o nome da marca">
                            <input type="text" class="form-control" id="novoNome" aria-describedby="atualizaNomeHelp" placeholder="Nome da marca" v-model="$store.state.item.nome">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component
                        titulo="Logo da marca"
                        id="atualizarImagem"
                        id-help="logoHelp"
                        texto-ajuda="Selecione o logo da marca">
                            <input type="file" class="form-control" id="inputAtualizacaoImagem" aria-describedby="logoHelp" placeholder="Logo da marca" @change="carregarImagem($event)">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component>
        <!-- FIM MODAL ATUALIZAR MARCA -->
    </div>
</template>

<script>
import InputContainer from './InputContainer.vue'
import Paginate from './Paginate.vue'
    export default {
  components: { Paginate, InputContainer },
        data() {
            return {
                urlBase: 'http://localhost:8002/api/v1/marca',
                nomeMarca: '',
                urlPaginacao :'',
                urlFiltro : '',
                marcas: { data: [] },
                busca: { id: '', nome: ''},
                arquivoImagem: [],
                transacaoStatus: '',
                transacaoDetalhes: [],
            }
        },
        computed: {
                token(){
                    return  'Bearer ' + document.cookie.split(';').find(row => row.includes('token=')).split('=')[1]
                }
            },
        methods: {
            atualizar(){
                let formData = new FormData();
                formData.append('_method', 'patch');
                formData.append('nome', this.$store.state.item.nome);

                if(this.arquivoImagemm[0]){
                    formData.append('imagem', this.arquivoImagem[0]);
                }

                let url = this.urlBase + '/' + this.$store.state.item.id;

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': this.token,
                        'Accept': 'application/json'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'Sucesso';
                        this.$store.state.transacao.message = response.data;
                        this.carregarLista();
                        inputAtualizacaoImagem.value = '';

                    })
                    .catch(error => {
                        this.$store.state.transacao.status = 'Erro';
                        this.$store.state.transacao.message = error.response.data;
                    })
            },
            remover(){
                let confirmacao = confirm('Deseja realmente remover essa marca?')

                if(!confirmacao) return false

                let formData = new FormData();
                formData.append('_method', 'DELETE')

                let config = {
                    headers: {
                        'Authorization': this.token,
                        'Accept': 'application/json'
                    }
                }

                let url = this.urlBase + '/' + this.$store.state.item.id


                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'Sucesso'
                        this.$store.state.transacao.message = 'Marca removida com sucesso'
                        this.carregarLista()
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'Erro'
                        this.$store.state.transacao.message = error.response.data.detalhes
                    })
            },
            pesquisar() {
                let filtro = ''
                for (let chave in this.busca) {
                   if(this.busca[chave]){
                    if (filtro != '') {
                        filtro += ';'
                    }

                        filtro += chave + ':like:' + this.busca[chave]
                    }
                }
                if(filtro != ''){
                    this.urlFiltro = '&filtro=' + filtro
                    this.urlPaginacao = 'page=1'
                } else {
                    this.urlFiltro = ''
                }
                this.carregarLista()
            },
            paginacao(l){
                if(l.url){
                    this.urlPaginacao = l.url.split('?')[1]
                    this.carregarLista()
                }
            },
            carregarLista() {
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro
                console.log(url)
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                axios.get(url, config)
                    .then(response => {
                        this.marcas = response.data
                        //console.log(this.marcas)
                    }).catch(error => {
                        console.log(error)
                    })
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files;
            },
            cadastrarMarca() {

                let formData = new FormData();

                formData.append('nome', this.nomeMarca);
                formData.append('imagem', this.arquivoImagem[0]);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                .then(response => {
                    console.log(response)
                    this.transacaoStatus = 'Adicionado'
                })
                .catch(error => {
                    console.log(error)
                    this.transacaoStatus = 'Erro'
                    this.transacaoDetalhes = error.response
                })
            }
        },
        mounted() {
            this.carregarLista()
        }
    }
</script>
