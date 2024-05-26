<template>
    <div>
        <section class="companyinfo">
            <div class="container">
                <div class="gallery-breadcrumb">
                    <span></span>
                    <p>Our Company Infoes</p>
                </div>
                <div class="gallery-img-container">
                    <div class="row">
                        <div class="col-sm-4" v-for="value in companyinfo">
                            <div class="gallery-img-box">
                                <img :src="value.image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


<script>
 import sidebar from '../components/includes/sidebar';
    export default {
        components: {
            sidebar,
        },
        data(){
            return {
                companyinfo: [],
            }
        },
        methods:{
            loadCompanyinfo(){
                axios.get('/api/v1/companyinfo').then(response => {
                    this.companyinfo = response.data.companyinfo;
                });
            }

        },

        mounted(){
            this.loadCompanyinfo();
        }
    }
</script>





