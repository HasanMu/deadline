<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <bagkiri-component></bagkiri-component>
            </div>
            <div class="col">
                <bagtengah-component></bagtengah-component>
            </div>
            <div class="col-md-3">
                <bagkanan-component></bagkanan-component>
            </div>
        </div>
    </div>
</template>

<script>
    import BagkiriComponent from './partial-home/BagKiriComponent.vue';
    import BagtengahComponent from './partial-home/BagTengahComponent.vue';
    import BagkananComponent from './partial-home/BagKananComponent.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {BagkiriComponent, BagtengahComponent, BagkananComponent}
    }
</script>
