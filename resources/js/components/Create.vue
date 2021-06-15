<template>
    <div class="card w-75">
        <div class="card-header w-100 text-uppercase text-lg-center">
            Add Product
        </div>
        <div class="card-body w-100">
            <form @submit.prevent="createProduct">
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
                <div class="form-group w-100">
                    <label for="picture" class="text-dark">Picture</label>
                    <input @change="uploadFile" :class="{'is-invalid' : form.errors.has('product_image')}" @keydown="form.errors.clear('product_image')" type="file" class="form-control-file" id="picture">
                    <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('product_image')" v-text="form.errors.get('product_image')"></span>
                </div>

                <button type="submit" class="btn btn-info">Submit</button>

            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                name: '',
                description: '',
                currency: 'MYR',
                price: '',
                stock: '',
                product_image: ''
            })
        }
    },

    methods:{
        createProduct(){
            let data = new FormData();
            _.forEach(this.form, (val, key) => {
                data.append(key, val || '');
            });

            axios.post('/products', data).then((res) =>{
                window.location.href = "/products/" + res.data.id
            }).catch((error) => {
                this.form.errors.record(error.response.data.errors)
            })
        },

        uploadFile(event){
            this.form.product_image = event.target.files[0];
        }
    },

    mounted() {

    }
}
</script>
