<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_6.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 text-center">
                        <h1 class="mb-0 bread">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 ">
                        <form action="#" class="billing-form">
                            <h3 class="mb-4 billing-heading">Billing Details</h3>
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >First Name</label>
                                        <span v-if="errors.firstname" class="error_red" > - {{errors.firstname[0]}}</span>
                                        <input type="text" class="form-control" v-model="firstname" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <span v-if="errors.lastname" class="error_red" > - {{errors.lastname[0]}}</span>
                                        <input type="text" class="form-control" v-model="lastname" >
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Address</label>
                                        <span v-if="errors.address" class="error_red" > - {{errors.address[0]}}</span>
                                        <input type="text" class="form-control" v-model="address" placeholder="House number and street name">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Phone</label>
                                        <span v-if="errors.phone" class="error_red" > - {{errors.phone[0]}}</span>
                                        <input type="text" class="form-control" v-model="phone" >
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="!$page.user">
                                    <div class="form-group">
                                        <label >Email Address</label>
                                        <span v-if="errors.email" class="error_red" > - {{errors.email[0]}}</span>
                                        <input type="text" class="form-control" v-model="email" name="email" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <div class="radio">
                                            <label v-if="!$page.user"><input type="radio" v-model="is_create_account" value="1" > Create an Account? </label>
                                            <label v-if="!$page.user"><input type="radio" v-model="is_create_account" value="2" > Don't create</label>
                                            &nbsp;&nbsp;&nbsp;<label v-if="!$page.user">( or <a href="/login"  >Login</a>)</label>
                                            <label v-if="$page.user"><input type="radio" v-model="is_create_account" value="3" > Authorized as {{$page.user.name}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" v-if="is_create_account == 1 && !$page.user" >
                                    <div class="form-group">
                                        <label >Password</label>
                                        <span v-if="errors.password" class="error_red" > - {{errors.password[0]}}</span>
                                        <input type="password" class="form-control" v-model="password" >
                                    </div>
                                </div>

                            </div>
                        </form><!-- END -->


                        <div class="row mt-5 pt-3 d-flex">
                            <div class="col-md-6 d-flex">
                                <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Cart Total</h3>
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
                            </div>
                            <div class="col-md-6">
                                <div class="cart-detail bg-light p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Payment</h3>
                                    <p><inertia-link href="#" class="btn btn-primary py-3 px-4" @click="createOrder($event)" >Place an order</inertia-link></p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .col-md-8 -->
                </div>
            </div>
        </section> <!-- .section -->


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
                subtotal: 0,
                delivery: 0,
                discount: 0,
                total: 0,
                sign: 0,
                currency: 'USD',

                is_create_account: 1,

                firstname: '',
                lastname: '',
                address: '',
                phone: '',
                email: '',
                password: '',

                errors: {},
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
            if (this.$page.user) {
                this.firstname = this.$page.user.name;
                this.email = this.$page.user.email;
                this.is_create_account = 3;
            }
            if (this.cart_items_count == 0){
                this.$inertia.visit('/');
            }
            this.getCart();
        },
        methods: {
            async getCart() {
                const params = {
                    carts: this.carts,
                    currency: this.currency
                };
                axios.get('/api/get_cart', { params }).then(response => {
                    if (response.data.success) {
                        this.subtotal = response.data.subtotal;
                        this.delivery = response.data.delivery;
                        this.discount = response.data.discount;
                        this.total = response.data.total;
                        this.sign = response.data.sign;
                    }
                });
            },
            currencyChange(value) {
                this.currency = value;
                this.getCart();
            },
            async createOrder(event) {
                event.preventDefault();
                const params = {
                    carts: this.carts,
                    firstname: this.firstname,
                    lastname: this.lastname,
                    address: this.address,
                    phone: this.phone,
                    email: this.email,
                    is_create_account: this.is_create_account,
                    password: this.password,
                };
                axios.post('/api/checkout', params).then(response => {
                    console.log(response.data);
                    if (response.data.success) {
                        this.carts = {};
                        this.cart_items_count = 0;
                        this.$cookies.set('carts', this.carts);
                        this.$cookies.set('cart_items_count', this.cart_items_count);
                        this.$inertia.visit('/success');

                    } else {
                        this.errors = response.data.errors;
                        alert('Some error');
                    }
                });
            }
        }
    }
</script>
