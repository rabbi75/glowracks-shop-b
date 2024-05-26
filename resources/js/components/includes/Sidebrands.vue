<template>
    <div>
        <div class="sidebar">
            <div class="custom-tree">
                <div class="title">
                    <h6>Brand</h6>
                </div>
                <ul class="mtree transit">
                    <li v-for="(brand,index) in brands">
                        <router-link :to="{name:'brandproduct', params:{slug:brand.slug}}"> 	
							{{brand.brandName}} 
						</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                brands: [],
            };
        },
        methods: {
            loadBrand() {
                axios.get("/api/v1/brands").then((response) => {
                    this.brands = response.data.brands;
                });
            },
        },
        mounted() {
            this.loadBrand();
        },
    };
</script>
