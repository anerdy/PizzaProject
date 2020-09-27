<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_6.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9  text-center">
                        <h1 class="mb-0 bread">Cart</h1>
                    </div>
                </div>
            </div>
        </div>

        <section style="padding: 100px 0;">
            <div class="container" v-if="cart_items_count > 0">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center" v-for="cart_item in cart_items" >
                                    <td class="product-remove"><a href="#" @click="removeItem($event, cart_item.id)"><span class="ion-ios-close"></span></a></td>

                                    <td class="image-prod"><div class="img" :style="'background-image:url('+cart_item.image_url+');'"></div></td>

                                    <td class="product-name">
                                        <h3>{{cart_item.name}}</h3>
                                        <p>{{cart_item.description}}</p>
                                    </td>

                                    <td class="price">{{cart_item.sign}}{{cart_item.price}}</td>

                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="number" name="quantity" class="quantity form-control input-number" :value="cart_item.quantity" min="1" max="100" @change="onQuantityChange($event, cart_item.id, $event.target.value)">
                                        </div>
                                    </td>

                                    <td class="total">{{cart_item.sign}}{{cart_item.total}}</td>
                                </tr><!-- END TR-->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ">
                        <div class="cart-total mb-3">
                            <h3>Cart Totals</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>{{sign}}{{subtotal}}</span>
                            </p>
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>{{sign}}{{delivery}}</span>
                            </p>
                            <p class="d-flex">
                                <span>Discount</span>
                                <span>{{sign}}{{discount}}</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{sign}}{{total}}</span>
                            </p>
                        </div>
                        <p class="text-center"><inertia-link href="/checkout" class="btn btn-primary py-3 px-4" >Proceed to Checkout</inertia-link></p>
                    </div>
                </div>
            </div>
            <div class="container" v-else>
                <h2>Empty cart</h2>
                <p>Please select a pizza on the <inertia-link href="/" >main page</inertia-link>.</p>
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
                cart_items: {},
                subtotal: 0,
                delivery: 0,
                discount: 0,
                total: 0,
                sign: 0,
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
            this.getCart();
        },
        methods: {
            async onQuantityChange(event, pizza_id, val) {
                event.preventDefault();
                let diff = this.carts[pizza_id] - val;
                for (let pizza_id_key in this.carts) {
                    if (pizza_id_key == pizza_id) {
                        this.carts[pizza_id] = val;
                    }
                }
                this.cart_items_count = this.cart_items_count - diff;
                this.$cookies.set('cart_items_count', this.cart_items_count);
                this.$cookies.set('carts', this.carts);
                this.getCart();
            },
            async getCart() {
                const params = {
                    carts: this.carts,
                    currency: this.currency
                };
                axios.get('/api/get_cart', { params }).then(response => {
                    if (response.data.success) {
                        this.cart_items = response.data.pizzas;
                        this.subtotal = response.data.subtotal;
                        this.delivery = response.data.delivery;
                        this.discount = response.data.discount;
                        this.total = response.data.total;
                        this.sign = response.data.sign;
                    }
                });
            },
            async removeItem(event, pizza_id) {
                event.preventDefault();
                console.log(this.carts);
                /*
                this.carts = Object.keys(this.carts).filter(pizza_id_key => {
                    return pizza_id_key != pizza_id;
                });
                this.getCart();
                */
               //  console.log(lists);
                this.cart_items_count = this.cart_items_count - this.carts[pizza_id];
                this.$cookies.set('cart_items_count', this.cart_items_count);
                delete this.carts[pizza_id];
                this.$cookies.set('carts', this.carts);

                this.getCart();
              //  console.log(lists);
                /*
                for (let pizza_id_key in this.carts) {
                    if (pizza_id_key == pizza_id) {

                    }
                }
                */
            },
            currencyChange(value) {
                this.currency = value;
                this.getCart();
            },
        }
    }
</script>
