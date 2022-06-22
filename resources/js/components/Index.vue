<template>
    <div class="p-mx-auto p-mt-3 p-mb-1" style="max-width: 1200px;">
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>

</style>
