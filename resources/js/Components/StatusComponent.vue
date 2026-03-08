<template>
    <div :class="class">
        <label class="form-label mb-2" :for="id">
            {{ label }}
            <sup class="text-danger" v-if="isRequired">*</sup>
        </label>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" :id="id" v-model="isChecked"
                :disabled="isDisabled" :required="isRequired" @change="handleChange" />

        </div>

        <div v-if="error" class="text-danger mt-1">{{ error }}</div>
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
        isDisabled: {
            type: Boolean,
            default: false,
        },
        modelValue: {
            type: [Boolean, Number, String],
            default: null,
        },
        activeValue: {
            type: [String, Number, Boolean],
            default: 1,
        },
        inactiveValue: {
            type: [String, Number, Boolean],
            default: 0,
        },
    },
    data() {
        return {
            isChecked: 1,
        };
    },
    emits: ['update:modelValue', 'onChange'],
    watch: {
        modelValue: {
            immediate: true,
            handler(newValue) {
                this.isChecked = newValue == this.activeValue;
            },
        },
    },
    methods: {
        handleChange() {
            const value = this.isChecked ? this.activeValue : this.inactiveValue;
            this.$emit('update:modelValue', value);
            this.$emit('onChange', value);
        },
    },

}
</script>

<style scoped>
.status-switch-wrapper {
    margin-bottom: 1rem;
}

.form-check-input {
    cursor: pointer;
    width: 3em;
    height: 1.5em;
}

.form-check-input:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

.form-check-label {
    cursor: pointer;
    margin-left: 0.5rem;
    font-weight: 500;
}

.form-check-input:focus {
    box-shadow: none !important;
}
</style>