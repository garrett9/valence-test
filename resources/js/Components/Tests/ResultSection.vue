<script setup>
defineProps({
    left: {
        required: true,
        type: String,
    },
    right: {
        required: true,
        type: String,
    },
    leans: {
        required: true,
        type: Boolean,
    }
});
</script>

<template>
    <div class="grid grid-cols-3 gap-x-6 items-center">
        <div>{{ left }}</div>
        <div>
            <div class="h-2 w-full bg-gray-200">
                <div class="h-2 w-1/2 bg-purple-400" :class="{ 'ml-auto': leans }"></div>
            </div>
        </div>
        <div>{{ right }}</div>
    </div>
</template>
