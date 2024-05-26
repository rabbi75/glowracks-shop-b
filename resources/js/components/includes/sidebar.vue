<template>
    <div class="hidemenu_margin">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div id="hidemenu" class="sidebar-float-menu">
                    <div class="sidebar-menu hover_category">
                        <ul v-if="categories.length > 0">
                            <li v-for="category in categories" :key="category.id">
                                <router-link :to="{name:'category', params: {slug:category.slug}}">
                                    <!-- <img :src="category.image" alt="" /> -->
                                    {{category.name}}
                                    <i v-if="category.subcategories.length > 0" class="fa fa-caret-right"></i>
                                </router-link>
                                <ul class="sidebar-submenu" v-if="category.subcategories.length > 0">
                                    <li v-for="hsubcategory in category.subcategories" :key="hsubcategory.id">
                                        <router-link :to="{name:'subcategory', params: {slug:hsubcategory.slug}}">
                                            {{hsubcategory.subcategoryName}}
                                            <i v-if="hsubcategory.childcategories.length > 0" class="fa fa-caret-right"></i>
                                        </router-link>
                                        <ul class="sidebar-childmenu" v-if="hsubcategory.childcategories.length > 0">
                                            <li v-for="childcategory in hsubcategory.childcategories" :key="childcategory.id">
                                                <router-link :to="{name:'products',params:{slug:childcategory.slug}}">{{childcategory.childcategoryName}}</router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                categories: [],
            };
        },
        methods: {
            loadData() {
                axios.get("/api/v1/all-category").then((response) => {
                    this.categories = response.data.categories;
                });
            },
        },
        mounted() {
            this.loadData();
        },
    };
</script>
