<script setup>
defineProps({
    header: String,
});
</script>

<template>
    <div class="rounded border-r border-l border-t p-5">
        <div class="text-center space-y-5">
            <div class="font-bold text-lg">
                {{ header }}
            </div>
            <slot></slot>
        </div>
    </div>
</template>
