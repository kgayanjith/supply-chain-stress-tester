<template>
    <div :class="class">
        <label :for="id" class="form-lable mb-2">{{ label }} <sup v-if="isRequired">*</sup> </label>
        <textarea :name="name" :id="id" v-model="model" :disabled="disabled" :required="isRequired" class="form-control" rows="3"></textarea>
        <div class="text-danger">
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            required: true,
        },
        class: {
            type: String,
            default: "mb-3 col-md-6",
        },
        name:{
            type:String,
            required:false,
        },
        label: {
            type: String,
            required: true,
        },
        error: {
            type: String,
            default: "",
        },
        isRequired: {
            type: Boolean,
            default: true,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        modelValue: {
            default: "",
        },
    },
    data() {
        return {
            model: this.modelValue,
        };
    },
    watch: {
        model(currentValue) {
            this.$emit("update:modelValue", currentValue);
        },
        modelValue(currentValue) {
            this.model = currentValue;
        },
    },
}
</script>

<style></style>