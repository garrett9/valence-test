<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import ResultSection from '../Components/Tests/ResultSection.vue';

const props = defineProps({
    test: Object,
    result: Object,
});

// TODO: Final result needs to be sorted based on the different dimensions that show first
let perspective = '';
for (const [key, value] of Object.entries(props.result.results)) {
    if (value <= 3.5) {
        perspective += key[0];
    } else {
        perspective += key[1];
    }
}
console.log(props.result.results);
</script>

<template>

    <Head :title="`${test.display_name} Results`" />

    <div class="max-w-6xl mx-auto py-20">
        <div class="border rounded flex flex-row justify-between p-10 items-center">
            <div>
                <h2 class="text-lg text-blue-900 font-bold">Your Perspective</h2>
                <div class="font-bold">Your Perspective Type is {{ perspective }}</div>
            </div>

            <div class="flex flex-col space-y-2">
                <ResultSection left="Introversion (I)" right="Extraversion (E)"
                    :leans="props.result.results['EI'] <= 3.5" />
                <ResultSection left="Sensing (S)" right="Intuition (N)" :leans="props.result.results['SN'] > 3.5" />
                <ResultSection left="Thinking (T)" right="Feeling (F)" :leans="props.result.results['TF'] > 3.5" />
                <ResultSection left="Judging (J)" right="Percieving (P)" :leans="props.result.results['JP'] > 3.5" />
            </div>
        </div>
    </div>
</template>

