<template>
    <div :class="estilo" role="alert">
        <h3>{{ titulo }}</h3>
        {{ detalhes.mensagem }}
        <hr>
        <ul v-if="detalhes.dados">
            <li v-for="erro, key in detalhes.dados" :key="key">
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
