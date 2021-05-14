<template>
  <div class="container">
    <div class="py-5 text-center">
      <h2>Welcome</h2>
      <p class="lead">{{user.first_name}} {{user.last_name}} has invited you to buy items</p>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Product</span>
        </h4>
        <ul class="list-group mb-3">
          <template v-for="product in products">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{product.title}}</h6>
                <small class="text-muted">{{product.description}}</small>
              </div>
              <span class="text-muted">{{product.price}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Quantity</h6>
              </div>
              <input v-model="quantities[product.id]" type="number" min="0" class="text-muted form-control Quantity">
            </li>
          </template>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total ($USD)</span>
                <strong>${{total}}</strong>
            </li>
        </ul>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Personal Info</h4>
        <form class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="First name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="Last name" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          </div>

          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" placeholder="country">
            </div>

            <div class="col-md-4 mb-3">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" placeholder="city">
            </div>

            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="zip" required>
            </div>
          </div>

          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import axios from 'axios'

export default Vue.extend( {
 async asyncData(ctx) {
    const {data} = await axios.get(`${process.env.BASE_URL}/links/${ctx.params.code}`);
    const user = data.data.user;
    const products = data.data.products;
    const quantities = [];

    products.forEach(
        p => quantities[p.id] = 0
    )

    return {
        user,
        products,
        quantities
    }
 },
 data() {
     return {
         user: null,
         products: [],
         quantities: []
     }
 },
    computed: {
     total() {
         let total = 0;

         this.products.forEach(
             p => {
                 total += p.price * this.quantities[p.id]
             }
         );

         return total;
     }
    }
})
</script>

<style scoped>

.Quantity {
    width: 65px;
}

</style>


