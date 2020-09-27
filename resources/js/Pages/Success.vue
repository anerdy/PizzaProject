<template>
    <div>
        <HeaderNav :cart_items_count='cart_items_count' />

        <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_6.jpg');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 text-center">
                        <h1 class="mb-0 bread">Success</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="ftco-gallery ftco-section ftco-no-pb">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 heading-section text-center mb-4">
                        <h2 class="mb-4">Order successfully created</h2>
                        <p>In the near future we will deliver your pizza to the specified address.</p>
                        <p>If you want, you can <inertia-link href="/" >create another order</inertia-link>.</p>
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
        },
        methods: {
            currencyChange(value) {
                this.currency = value;
            },
        }
    }
</script>
