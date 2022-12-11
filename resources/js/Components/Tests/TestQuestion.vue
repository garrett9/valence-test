<script setup>
import RadioInput from './RadioInput.vue';

defineProps({
    modelValue: Number,
    radioName: {
        required: true,
        type: String,
    },
});

defineEmits(['update:modelValue']);

</script>

<template>
    <div class="flex flex-inline items-center justify-between max-w-lg mx-auto">
        <div class="text-red-700">Disagree</div>
        <div v-for="i in 7" :key="i">
            <RadioInput @input="$emit('update:modelValue', $event.target.value)" :value="i" :name="radioName" />
        </div>
        <div class="text-green-700">Agree</div>
    </div>
</template>
