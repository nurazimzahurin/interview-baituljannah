<template>
    <div class="container w-100 justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="card w-75">
                <div class="card-header w-100 text-uppercase text-lg-center">
                    Edit Product
                </div>
                <div class="card-body w-100">
                    <form @submit.prevent="editProduct">
                        <div class="form-group w-100">
                            <label for="name" class="text-dark">Name</label>
                            <input v-model="form.name" :class="{'is-invalid' : form.errors.has('name')}" @keydown="form.errors.clear('name')" type="text" class="form-control" id="name" >
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="description" class="text-dark">Description</label>
                            <textarea v-model="form.description" :class="{'is-invalid' : form.errors.has('description')}" @keydown="form.errors.clear('description')" class="form-control" id="description" rows="3"></textarea>
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="currency" class="text-dark">Currency</label>
                            <input v-model="form.currency" :class="{'is-invalid' : form.errors.has('currency')}" @keydown="form.errors.clear('currency')" type="text" class="form-control" id="currency">
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('currency')" v-text="form.errors.get('currency')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="price" class="text-dark">Price</label>
                            <input v-model.number="form.price" :class="{'is-invalid' : form.errors.has('price')}" @keydown="form.errors.clear('price')" type="number" class="form-control" id="price" step="0.01">
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('price')" v-text="form.errors.get('price')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="stock" class="text-dark">Stock</label>
                            <input v-model.number="form.stock" :class="{'is-invalid' : form.errors.has('stock')}" @keydown="form.errors.clear('stock')" type="number" class="form-control" id="stock">
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('stock')" v-text="form.errors.get('stock')"></span>
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product', 'url'],
    data() {
        return {
            form: new Form({
                name: this.product.name,
                description: this.product.description,
                currency: this.product.currency,
                price: this.product.price,
                stock: this.product.stock
            })
        }
    },

    methods:{
        editProduct(){
            let data = new FormData();
            _.forEach(this.form, (val, key) => {
                data.append(key, val || '');
            });

            axios.patch('/products/' + this.product.id, this.form).then((res) =>{
                window.location.href = "/products/" + res.data.id
            }).catch((error) => {
                this.form.errors.record(error.response.data.errors)
            })
        }
    },
}
</script>
