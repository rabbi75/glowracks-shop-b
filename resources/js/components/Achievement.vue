<template>
    <div>
        <section class="achievement">
            <div class="container">
                <div class="gallery-breadcrumb">
                    <span></span>
                    <p>Our Achievements</p>
                </div>
                <div class="gallery-img-container">
                    <div class="row">
                        <div class="col-sm-4" v-for="value in achievement">
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
                achievement: [], 
            }
        },
        methods:{
            loadAchievement(){
                axios.get('/api/v1/achievement').then(response => {
                    this.achievement = response.data.achievement;
                });
            }

        },

        mounted(){
            this.loadAchievement();
        }
    }
</script>





