<template>
    <div class="container w-100 justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="card w-75">
                <div class="card-header w-100 text-uppercase text-lg-center">
                    View Product
                </div>
                <div class="card-body w-100 align-items-center justify-content-center">
                    <h5 class="card-title w-100 w-100 text-center" v-html="product.name"></h5>
                    <div class="w-100 text-center">
                        <img class="card-img container-img text-center" v-bind:src="url" />
                    </div>
                    <b>Description : </b>
                    <p class="card-text text-dark w-100 text-left" v-html="product.description"></p>
                    <b>Price : </b>
                    <p class="card-text text-dark w-100 text-left" v-html="product.currency + ' ' + product.price"></p>
                    <b>Stock Inventory : </b>
                    <p class="card-text text-dark w-100 text-left" v-html="product.stock"></p>
                    <div class="w-100 text-right" v-if="owner">
                        <a href="" class="btn btn-danger align" v-on:click.prevent="redirectDelete">Delete</a>
                    </div>
                    <div class="w-100 text-right" v-if="owner">
                        <a href="" class="btn btn-primary align" v-on:click.prevent="redirectEdit">Edit</a>
                    </div>
                </div>
                <div class="card-footer text-muted" v-html="product.created_at">
                </div>
            </div>
        </div>
        <Review :product="product" :reviews="product.reviews" :rating="product.overall_rating" :owner="owner"></Review>
    </div>
</template>

<script>
import Review from './Review';
export default {
    props: ['product', 'url'],
    data() {
        return {
            owner: false,
            deleted: false
        }
    },
    components: {
        Review
    },
    methods: {
        redirectEdit(){
            window.location.href = "/products/" + this.product.id + "/edit"
        },
        checkOwner(){
            axios.get('/products/'+this.product.id+'/owner').then((res) =>{
               this.owner = res.data
            })
        },
        redirectDelete(){
            axios.delete('/products/'+this.product.id).then((res) =>{
                if (res.data) {
                    alert('Product deleted')
                    window.location.href = "/products/"
                }
            })
        }
    },
    mounted() {
        this.checkOwner()
    }
}
</script>
