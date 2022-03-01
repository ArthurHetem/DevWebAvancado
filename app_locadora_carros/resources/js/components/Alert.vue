<template>
    <div class="alert {{ tipoAlerta }}" role="alert">
        <slot/>
    </div>
</template>

<script>
    export default {
        data: 'tipoAlerta'
    }
</script>
