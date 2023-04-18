<template>
    <div class="card w-100">
        <div class="card-body">
            <div class="car-details">
                <div class="img-box">
                    <img :src="main_image" class="card-img mb-2" />
                </div>
                <div class="car-title">
                    <router-link :to="{ name: 'bookable', params: { id } }">
                        <h5 class="car-name">{{ title }}</h5>
                        <div class="car-year">2018</div>
                    </router-link>
                </div>
            </div>
            <div class="car-features">
                <div> X automata </div>
                <div> X benzina </div>
                <div> X 5 locuri </div>
                <div> X 90cp </div>
            </div>
            <div class="car-cta">
                <div class="car-price">50 lei<span>/zi</span></div>
                <div class="car-button">Detalii</div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: { title: String, description: String, id: Number, main_image: String },
};
</script>


