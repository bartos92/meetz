<template>
    <div class="wrapper">
        <header-component />
        <sidebar-component />
        <router-view></router-view>
    </div>
</template>

<script>
    import HeaderComponent from './components/Header.vue';
    import SidebarComponent from './components/Sidebar.vue';
    export default {
        name: "main-component",
        components: {
            HeaderComponent,
            SidebarComponent,

        }
    }
</script>

<style scoped>

</style>
