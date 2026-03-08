<template>
    <div :class="class">
        <label :for="id" class="form-lable mb-2">{{ label }} <sup v-if="isRequired">*</sup> </label>
        <input :type="type" class="form-control" :name="name" :id="id" v-model="model" :disabled="disabled"
            :pattern="pattern" :required="isRequired" :readonly="readonly">
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
        name: {
            type: String,
            required: false,
        },
        class: {
            type: String,
            default: "mb-3 col-md-6",
        },
        label: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: "text",
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
        readonly: {
            type: Boolean,
            default: false,
        },
        modelValue: {
            default: "",
        },
        pattern: {
            type: String,
            required: false,
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