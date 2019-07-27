<template>
    <div>
        <div class="menu">
            <div class="container">
                <div class="menu-int">
                    <div class="logo">
                        <img width="120px" src="/img/logo_neoway_alt_new.svg">
                    </div>
                    <div class="items">
                        <router-link :to="{name: 'status'}"><a href="#">Status</a></router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MenuComponent"
    }
</script>

<style scoped>
    .menu{
        display: flex;
        background: #1b4b72;
    }
    .menu-int{
        display: flex;
        justify-content: space-between;
    }
    .logo{
        display: flex;
    }
    .items{
        display: flex;
        align-items: center;
    }
    .items a{
        color: #ffffff;
    }
</style>