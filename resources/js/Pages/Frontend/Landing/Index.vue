<template>
  <AppLayout>
    <div class="mt-4">
      <HerosectionSlider :featuredproducts="featuredproducts" />
      <Categories :categories="categories" />
      <Latestproducts :latestproducts="latestproducts" />
      <Mostordered :mostorderedproducts="mostorderedproducts" />
      <Promotionbanner :banners="banners" />
    </div>
  </AppLayout>

</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import HerosectionSlider from './partials/HerosectionSlider.vue';
import Categories from './partials/Categories.vue';
import Latestproducts from './partials/Latestproducts.vue';
import Mostordered from './partials/Mostordered.vue';
import Promotionbanner from './partials/Promotionbanner.vue';


export default {
  components: {
    AppLayout,
    HerosectionSlider,
    Categories,
    Latestproducts,
    Mostordered,
    Promotionbanner
  },
  props: {
    banners: Object,
    categories: Object,
    latestproducts:Object,
    featuredproducts:Object,
    mostorderedproducts:Object
  }
}
</script>

<style scoped>
*{
    font-family: "DM Sans", sans-serif;
}
</style>