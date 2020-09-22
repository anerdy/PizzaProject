<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_6.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 text-center">
                        <h1 class="mb-0 bread">{{pizza.name}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <section style="padding: 100px 0;" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 ">
                        <a :href="pizza.image_url" class="image-popup prod-img-bg"><img :src="pizza.image_url" class="img-fluid" :alt="pizza.name"></a>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ">
                        <h3>{{pizza.name}}</h3>
                        <p class="price"><span>{{pizza.sign}}{{pizza.price}}</span></p>
                        <p>{{pizza.description}}</p>
                        <p>
                            <a href="#" class="btn btn-black py-3 px-5 mr-2" @click="addToCart($event, pizza.id)" >Add to Cart</a>
                            <a href="#" class="btn btn-primary py-3 px-5" @click="buyNow($event, pizza.id)" >Buy now</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <Footer v-on:currency="currencyChange" />

    </div>
</template>

<script>
    import HeaderNav from './../Common/HeaderNav';
    import Footer from './../Common/Footer';

    export default {
        components: {
            HeaderNav,
            Footer
        },
        data() {
            return {
                cart_items_count: 0,
                carts: {},
                pizza: {},
                currency: 'USD'
            }
        },
        mounted() {
            if ( this.$cookies.get('cart_items_count') !== null ){
                this.cart_items_count = this.$cookies.get('cart_items_count');
            }
            if ( this.$cookies.get('carts') !== null ){
                this.carts = this.$cookies.get('carts');
            }
            if ( this.$cookies.get('currency') !== null ){
                this.currency = this.$cookies.get('currency');
            }
            this.getPizza();
        },
        methods: {
            async getPizza() {
                let pizza_id = window.location.href.split('/').pop();
                const params = {
                    currency: this.currency
                };
                axios.get('/api/get_pizza/'+pizza_id, { params }).then(response => {
                    this.pizza = response.data;
                });
            },
            addToCart(event, pizza_id) {
                event.preventDefault();
                this.addItemInCart(pizza_id);
            },
            buyNow(event, pizza_id) {
                event.preventDefault();
                this.addItemInCart(pizza_id);
                this.$inertia.visit('/cart');
            },
            addItemInCart(pizza_id) {
                this.cart_items_count++;
                this.$cookies.set('cart_items_count', this.cart_items_count);

                if ( Object.keys(this.carts).length > 0 ) {
                    let found = false;

                    for (let pizza_id_key in this.carts) {
                        if (pizza_id_key == pizza_id) {
                            this.carts[pizza_id_key]++;
                            found = true;
                        }
                    }
                    if ( ! found) {
                        this.carts = Object.assign(this.carts, {
                            [pizza_id]: 1
                        });
                    }

                } else {
                    this.carts = Object.assign(this.carts, {
                        [pizza_id]: 1
                    });
                }
                this.$cookies.set('carts', this.carts);
            },
            currencyChange(value) {
                this.currency = value;
                this.getPizza();
            },
        }
    }
</script>
