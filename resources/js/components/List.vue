<template>
    <div class="container w-100 justify-content-center">
        <div class="row justify-content-center w-100 mb-2" v-for="product in products" :key="product.id">
            <a href="" class="nav-link w-75" v-on:click.prevent="redirectShow(product.id)">
                <div class="card w-100">
                    <div class="card-header w-100 text-uppercase text-left">
                        <ul class="nav nav-pills card-header-pills w-100">
                            <li class="nav-item">
                                <h4>{{ product.name }}</h4>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link text-right" v-on:click.prevent="redirectShow(product.id)"></a>
                            </li>
                        </ul>
                        <!--                    <h4>{{ product.name }}</h4>-->
                        <!--                    <a href="" class="btn btn-primary text-right" v-on:click.prevent="redirectShow(product.id)"></a>-->
                    </div>
                    <div class="card-body w-100 align-items-center justify-content-center">
                        <b>Description : </b>
                        <p class="card-text text-dark w-100 text-left">{{ product.description }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        by {{ product.author.name}} at {{ product.created_at }}
                    </div>
                </div>
            </a>


        </div>
    </div>
</template>

<script>
    export default {
        props: ['products'],
        methods: {
            redirectShow(id){
                console.log(id)
                window.location.href = "/products/" + id
            }
        }
    }
</script>
