<template>
    <div class="card bg-light mb-3">
        <div class="card-header">{{ stats }}</div>
            <div class="card-body">
                <h5 class="card-title">Light card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
    </div>
</template>

<script>
    export default {
        mounted () {
            console.log('Component Mounted.');
        },
        data () {
            return {
                stats: "{{ Auth::check() }}"
            }
        },
        created () {
            this.isLogged();
        },
        methods: {
            isLogged() {
                axios.get('/api/v1/isLogged')
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                })
            }
        }
    }
</script>
