<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{product.id}}</td>
                <td><img :src="product.image" height="50"/></td>
                <td>{{product.title}}</td>
                <td>{{product.description}}</td>
                <td>{{product.price}}</td>
                <td>
                    <div class="btn-group mr-2">
                        <router-link :to="`/products/${product.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</router-link>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary" @click="del(product.id)">Delete</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--<Paginator :last-Page="lastPage" @page-changed="load($event)"/>-->
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" @click="prev">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" @click="next">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script lang="ts">
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import {Entity} from "@/interfaces/entity";
    // import Paginator from "@/secure/components/Paginator.vue";

    export default {
        name: "Products",
        // components: {Paginator},
        setup() {
            const products = ref([]);
            const page = ref(1);
            const lastpage = ref(0);

            const load = async () => {
                const response = await axios.get(`products?page=${page.value}`);
                products.value = response.data.data;
                lastpage.value = response.data.meta.last_page;
            }

            const next = async () => {
                if(page.value === lastpage.value) return;

                page.value++;
                await load();
            }
            const prev = async () => {
                if(page.value === 1) return;

                page.value--;
                await load();
            }

            onMounted(load);

            const del = async (id: number) => {
                if(confirm('Are you sure you want to delete this record?')) {
                    await axios.delete(`products/${id}`);
                    products.value = products.value.filter((e: Entity) => e.id !== id);
                }
            }

            return {
                products,
                next,
                prev,
                del
            }
        }
    }
</script>

