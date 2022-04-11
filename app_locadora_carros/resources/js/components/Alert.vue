<template>
    <div :class="estilo" role="alert">
        <h3>{{ titulo }}</h3>
        <span v-if="detalhes.data.message">{{ detalhes.data.message }}</span>
        <span v-if="detalhes.data.id">{{'Id do registro: ' + detalhes.data.id }}</span>
        <hr>
        <ul v-if="detalhes.data.errors">
            <li v-for="erro, key in detalhes.data.errors" :key="key">
                {{ erro[0] }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['tipo', 'titulo', 'detalhes'],
        computed: {
            estilo(){
                return `alert alert-`+this.tipo;
            }
        }
    }
</script>
