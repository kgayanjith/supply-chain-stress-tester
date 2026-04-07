<template>
    <div :class="class">
        <div class="select2-wrapper" ref="wrapper">
             <label class="form-lable mb-2">{{ label }} <sup v-if="isRequired">*</sup> </label>
            <!-- Selected Display -->
            <div class="select2-control" :class="{ open: isOpen, disabled: disabled }" @click="toggleDropdown">
                <!-- Multiple Tags -->
                <div v-if="isMultiple" class="select2-tags">
                    <span v-for="val in selectedValues" :key="val" class="select2-tag">
                        {{ getLabel(val) }}
                        <span class="select2-tag-remove" @click.stop="removeValue(val)">&times;</span>
                    </span>
                    <input v-if="isOpen" ref="searchInput" v-model="search" class="select2-search-inline"
                        :placeholder="selectedValues.length === 0 ? placeholder : ''" @click.stop
                        @keydown.backspace="onBackspace" />
                    <span v-if="!isOpen && selectedValues.length === 0" class="select2-placeholder">
                        {{ placeholder }}
                    </span>
                </div>

                <!-- Single Value -->
                <div v-else class="select2-single">
                    <span v-if="selectedValues.length" class="select2-selected-label">
                        {{ getLabel(selectedValues[0]) }}
                    </span>
                    <span v-else class="select2-placeholder">{{ placeholder }}</span>
                </div>

                <span class="select2-arrow" :class="{ rotated: isOpen }">&#8964;</span>
            </div>

            <!-- Dropdown -->
            <div v-if="isOpen" class="select2-dropdown">
                <!-- Search (single mode) -->
                <div v-if="!isMultiple" class="select2-search-box">
                    <input ref="searchInput" v-model="search" class="select2-search-input" placeholder="Search..."
                        @click.stop />
                </div>

                <!-- Options -->
                <ul class="select2-options">
                    <li v-for="option in filteredOptions" :key="option.value" class="select2-option"
                        :class="{ selected: isSelected(option.value), highlighted: highlightedIndex === filteredOptions.indexOf(option) }"
                        @click.stop="selectOption(option)">
                        <span class="select2-option-check">&#10003;</span>
                        {{ option.label }}
                    </li>
                    <li v-if="filteredOptions.length === 0" class="select2-no-results">
                        No results found
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Select2Component",
    props: {
        modelValue: { default: null },
        options: { type: Array, default: () => [] },
        // options format: [{ value: 1, label: 'Text' }]
        placeholder: { type: String, default: "Select an option" },
        isMultiple: { type: Boolean, default: false },
        disabled: { type: Boolean, default: false },
        searchable: { type: Boolean, default: true },
        class: {
            type: String,
            default: "mb-3 col-md-6",
        },
          label: {
            type: String,
            required: true,
        },
          isRequired: {
            type: Boolean,
            default: true,
        },
    },
    emits: ["update:modelValue"],
    data() {
        return {
            isOpen: false,
            search: "",
            highlightedIndex: -1,
        };
    },
    computed: {
        selectedValues() {
            if (this.isMultiple) {
                return Array.isArray(this.modelValue) ? this.modelValue : [];
            }
            return this.modelValue !== null && this.modelValue !== undefined
                ? [this.modelValue]
                : [];
        },
        filteredOptions() {
            if (!this.search) return this.options;
            return this.options.filter((o) =>
                o.label.toLowerCase().includes(this.search.toLowerCase())
            );
        },
    },
    methods: {
        toggleDropdown() {
            if (this.disabled) return;
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.search = "";
                this.$nextTick(() => {
                    this.$refs.searchInput?.focus();
                });
            }
        },
        selectOption(option) {
            if (this.isMultiple) {
                let newVal = [...this.selectedValues];
                const idx = newVal.indexOf(option.value);
                if (idx === -1) {
                    newVal.push(option.value);
                } else {
                    newVal.splice(idx, 1);
                }
                this.$emit("update:modelValue", newVal);
                this.search = "";
                this.$nextTick(() => this.$refs.searchInput?.focus());
            } else {
                this.$emit("update:modelValue", option.value);
                this.isOpen = false;
                this.search = "";
            }
        },
        removeValue(val) {
            const newVal = this.selectedValues.filter((v) => v !== val);
            this.$emit("update:modelValue", newVal);
        },
        isSelected(val) {
            return this.selectedValues.includes(val);
        },
        getLabel(val) {
            const opt = this.options.find((o) => o.value == val);
            return opt ? opt.label : val;
        },
        onBackspace() {
            if (!this.search && this.selectedValues.length) {
                this.removeValue(this.selectedValues[this.selectedValues.length - 1]);
            }
        },
        handleOutsideClick(e) {
            if (!this.$refs.wrapper?.contains(e.target)) {
                this.isOpen = false;
            }
        },
    },
    mounted() {
        document.addEventListener("click", this.handleOutsideClick);
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleOutsideClick);
    },
};
</script>

<style scoped>
.select2-wrapper {
    position: relative;
    width: 100%;
    font-family: inherit;
    /* font-size: 14px; */
}

.select2-control {
    display: flex;
    align-items: center;
    min-height: 38px;
    border: 1px solid #d3d3d3;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    padding: 4px 30px 4px 8px;
    position: relative;
    transition: border-color 0.2s;
}

.select2-control.open,
.select2-control:hover {
    border-color: #aaa;
}

.select2-control.disabled {
    background: #f5f5f5;
    cursor: not-allowed;
    opacity: 0.7;
}

/* Arrow */
.select2-arrow {
    position: absolute;
    right: 10px;
    /* font-size: 18px; */
    color: #888;
    transition: transform 0.2s;
    line-height: 1;
}

.select2-arrow.rotated {
    transform: rotate(180deg);
}

/* Placeholder */
.select2-placeholder {
    color: #aaa;
}

/* Single */
.select2-single {
    flex: 1;
}

.select2-selected-label {
    color: #333;
}

/* Tags (multiple) */
.select2-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    flex: 1;
    align-items: center;
}

.select2-tag {
    display: inline-flex;
    align-items: center;
    background: #e9f0fb;
    color: #2a60d4;
    border-radius: 3px;
    padding: 2px 6px;
    /* font-size: 13px; */
    gap: 4px;
}

.select2-tag-remove {
    cursor: pointer;
    font-size: 15px;
    line-height: 1;
    color: #2a60d4;
}

.select2-tag-remove:hover {
    color: red;
}

.select2-search-inline {
    border: none;
    outline: none;
    font-size: 14px;
    min-width: 80px;
    flex: 1;
}

/* Dropdown */
.select2-dropdown {
    position: absolute;
    top: calc(100% + 2px);
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #d3d3d3;
    border-radius: 4px;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Search box */
.select2-search-box {
    padding: 6px 8px;
    border-bottom: 1px solid #eee;
}

.select2-search-input {
    width: 100%;
    border: 1px solid #d3d3d3;
    border-radius: 3px;
    padding: 5px 8px;
    /* font-size: 14px; */
    outline: none;
    box-sizing: border-box;
}

.select2-search-input:focus {
    border-color: #aaa;
}

/* Options list */
.select2-options {
    list-style: none;
    margin: 0;
    padding: 4px 0;
    max-height: 220px;
    overflow-y: auto;
}

.select2-option {
    padding: 7px 12px 7px 30px;
    cursor: pointer;
    position: relative;
    color: #333;
    transition: background 0.15s;
}

.select2-option:hover,
.select2-option.highlighted {
    background: #f0f4ff;
}

.select2-option.selected {
    color: #2a60d4;
    font-weight: 500;
}

.select2-option-check {
    position: absolute;
    left: 10px;
    opacity: 0;
    color: #2a60d4;
    font-size: 13px;
}

.select2-option.selected .select2-option-check {
    opacity: 1;
}

.select2-no-results {
    padding: 10px 12px;
    color: #999;
    /* font-style: italic; */
}
</style>