<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                <th v-if="visualizar.visivel || atualizar || remover"></th>
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
                <td v-if="visualizar.visivel || atualizar || remover">
                    <button v-if="visualizar.visivel" type="button" class="btn btn-sm btn-outline-primary" :data-bs-toggle="visualizar.dataToggle" :data-bs-target="visualizar.dataTarget">Visualizar</button>
                    <button v-if="atualizar" type="button" class="btn btn-sm btn-outline-primary" @click="editar(obj)">Editar</button>
                    <button v-if="remover" type="button" class="btn btn-sm btn-outline-danger" @click="excluir(obj)">Excluir</button>
                </td>
            </tr>
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
