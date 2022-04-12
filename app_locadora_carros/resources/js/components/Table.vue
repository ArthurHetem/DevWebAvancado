<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                <th v-if="visualizar || atualizar || remover"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                <td v-for="valor, chaveValor in obj" :key="chaveValor">
                    <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'data'">{{ '...'+valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'imagem'">
                        <img :src="'/storage/'+valor" :alt="valor" width="30" height="30">
                    </span>
                </td>
                <td v-if="visualizar || atualizar || remover">
                    <button v-if="visualizar" type="button" class="btn btn-sm btn-outline-primary" @click="editar(obj)">Visualizar</button>
                    <button v-if="atualizar" type="button" class="btn btn-sm btn-outline-primary" @click="editar(obj)">Editar</button>
                    <button v-if="remover" type="button" class="btn btn-sm btn-outline-danger" @click="excluir(obj)">Excluir</button>
                </td>
            </tr>
            <!-- <tr v-for="obj in dados" :key="obj.id">
                <td v-if="titulos.includes(chave)" v-for="valor, chave in obj" :key="chave">
                    <span v-if="chave == 'imagem'">
                        <img :src="valor" width="30" height="30">
                    </span>
                    <span v-else>
                        {{ valor }}
                    </span>
                </td>
                <th scope="row">{{ m.id }}</th>
                <td>{{ m.nome }}</td>
                <td><img :src="'/storage/' + m.imagem" width="30" height="30"></td>
            </tr> -->
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['titulos', 'dados', 'visualizar', 'atualizar', 'remover'],
        computed: {
            dadosFiltrados(){
                let campos = Object.keys(this.titulos)
                let dadosFiltrados = []
                this.dados.map((item, chave) => {
                    let itemFiltrado = {}
                    campos.forEach(campo => {
                        itemFiltrado[campo] = item[campo]
                        //console.log(itemFiltrado)
                    })
                    dadosFiltrados.push(itemFiltrado)
                })
                //console.log(dadosFiltrados)
                return dadosFiltrados
            }
        }
    }
</script>
