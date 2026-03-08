<template>
    <div class="mb-5">
        <h4 class="fw-bold ">{{ title }}</h4>
        <p class="text-secondary">{{ subtitle }}</p>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        subtitle: String,
    },
}
</script>