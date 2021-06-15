<template>
    <div class="row justify-content-center w-100">
        <div class="card w-75">
            <div class="card-header w-100 text-uppercase text-lg-center">
                Product Review
            </div>
            <div class="card-body w-100 align-items-center justify-content-center" v-if="!owner">
                <div class="card-header">
                    Leave a review
                </div>
                <div class="card-body w-100">
                    <form @submit.prevent="reviewProduct">
                        <div class="form-group w-100">
                            <label for="title" class="text-dark">Title</label>
                            <input v-model="form.title" :class="{'is-invalid' : form.errors.has('title')}" @keydown="form.errors.clear('title')" type="text" class="form-control" id="title" >
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="comment" class="text-dark">Comment</label>
                            <textarea v-model="form.comment" :class="{'is-invalid' : form.errors.has('comment')}" @keydown="form.errors.clear('comment')" class="form-control" id="comment" rows="3"></textarea>
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('comment')" v-text="form.errors.get('comment')"></span>
                        </div>
                        <div class="form-group w-100">
                            <label for="rating" class="text-dark">Rating</label>
                            <select class="custom-select" id="rating" v-model="form.rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                            <span class="text-danger pt-3 pb-3" style="font-size:10px;" v-if="form.errors.has('rating')" v-text="form.errors.get('rating')"></span>
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="card w-75">
            <div class="card-header w-100 text-uppercase text-lg-center">
                Overall Rating {{rating}}
            </div>
            <ul class="list-group list-group-flush w-100" v-for="review in reviews" :key="review.id">
                <li class="list-group-item w-100">
                    <div class="card w-100">
                        <div class="card-header w-100 text-uppercase text-lg-center">
                            {{review.title}} with rating {{review.rating}}
                        </div>
                        <blockquote class="blockquote w-100">
                            <p class="mb-0 ml-2">{{review.comment}}</p>
                            <footer class="blockquote-footer ml-2">by {{review.reviewer.name}} at <cite title="Source Title">{{ review.created_at }}</cite></footer>
                        </blockquote>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['reviews', 'rating', 'product', 'owner'],
    data() {
        return {
            form: new Form({
                title: '',
                comment: '',
                rating: ''
            })
        }
    },

    methods:{
        reviewProduct(){
            let data = new FormData();
            _.forEach(this.form, (val, key) => {
                data.append(key, val || '');
            });

            axios.post('/product/'+this.product.id+'/review', data).then((res) =>{
                window.location.href = "/products/" + res.data.product.id
            }).catch((error) => {
                if (error.response.status == 403) {
                    alert(error.response.data.message)
                } else {
                    this.form.errors.record(error.response.data.errors)
                }
            })
        },
    },
}
</script>
