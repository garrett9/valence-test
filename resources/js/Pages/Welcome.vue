<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import TestQuestion from '../Components/Tests/TestQuestion.vue';
import TestFormSection from '../Components/Tests/TestFormSection.vue';
import TextInput from '../Components/TextInput.vue';
import PrimaryButton from '../Components/PrimaryButton.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    test: Object,
    errors: Object,
});

const answers = props.test.questions.map((question) => {
    return {
        id: question.id,
        text: question.text,
        value: null,
    };
});

const form = reactive({
    answers,
    email: null,
});

const submit = () => {
    Inertia.post(`/tests/${props.test.id}/submit`, form);
};

</script>

<template>

    <Head :title="test.display_name" />

    <form @submit.prevent="submit" class="max-w-6xl mx-auto py-20 leading-10">
        <h2 class="text-lg text-blue-900 font-bold">{{ test.display_name }}</h2>
        <div>{{ test.description }}</div>

        <div class="max-w-3xl mx-auto pt-5 pb-10 grid">
            <TestFormSection v-for="(answer, i) in answers" :key="answer.id" :header="answer.text">
                <TestQuestion v-model="answer.value" :radio-name="`question-${answer.id}`" />
                <div class="text-red-600" v-if="errors[`answers.${i}.value`]">Please select a value.</div>
            </TestFormSection>
            <TestFormSection class="border-b" header="Your Email">
                <TextInput v-model="form.email" type="email" class="w-3/4" placeholder="Email Address" required />
                <div class="text-red-600" v-if="errors.email">{{ errors.email }}</div>
            </TestFormSection>
        </div>

        <div class="text-center">
            <PrimaryButton>Save & Continue</PrimaryButton>
        </div>
    </form>
</template>
