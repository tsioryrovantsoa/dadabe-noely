<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { login } from '@/routes';
import { index } from '@/routes/gifts';
import { index as wishesIndex, store } from '@/routes/wishes';
import type { Gift } from '@/types';

defineOptions({ layout: ChristmasLayout });

const props = defineProps<{
    gift: Gift;
    isInWishlist: boolean;
    isWishlistValidated: boolean;
}>();

const page = usePage();

const child = computed(() => page.props.auth.child);

const isAffordable = computed(
    () => !!child.value && props.gift.points <= child.value.available_points,
);
</script>

<template>
    <Head :title="gift.name" />

    <Link :href="index()" class="text-sm text-bark-soft underline">
        Retour au catalogue
    </Link>

    <div class="mt-6 grid gap-8 md:grid-cols-2">
        <img
            v-if="gift.image"
            :src="gift.image"
            :alt="gift.name"
            class="aspect-4/3 w-full rounded-cozy object-cover shadow-sm"
        />
        <div
            v-else
            class="flex aspect-4/3 w-full items-center justify-center rounded-cozy bg-cream-dark font-display text-xl text-bark-soft"
        >
            {{ gift.name }}
        </div>

        <div class="flex flex-col">
            <p class="text-xs tracking-wide text-bark-soft uppercase">
                {{ gift.category.name }}
            </p>
            <h1 class="mt-1 font-display text-4xl font-bold text-berry">
                {{ gift.name }}
            </h1>
            <p class="mt-4 font-display text-2xl font-bold text-pine">
                {{ gift.points }} bons points
            </p>

            <div class="mt-8">
                <p v-if="!child" class="text-bark-soft">
                    <Link :href="login()" class="text-berry underline"
                        >Connecte-toi</Link
                    >
                    pour ajouter ce cadeau à ta liste.
                </p>

                <p v-else-if="isWishlistValidated" class="text-bark-soft">
                    Ta liste est déjà validée, elle ne peut plus être modifiée.
                </p>

                <p v-else-if="isInWishlist" class="text-pine">
                    Ce cadeau est déjà dans
                    <Link :href="wishesIndex()" class="underline"
                        >ta liste de souhaits</Link
                    >.
                </p>

                <p v-else-if="!isAffordable" class="text-berry">
                    Il ne te reste que {{ child.available_points }} bons points,
                    ce cadeau est trop cher.
                </p>

                <Form
                    v-else
                    v-bind="store.form()"
                    #default="{ processing }"
                    class="flex flex-col gap-2"
                >
                    <input type="hidden" name="gift_id" :value="gift.id" />
                    <button
                        type="submit"
                        :disabled="processing"
                        class="rounded-cozy bg-berry px-8 py-3 font-display text-lg font-semibold text-cream hover:bg-berry-dark disabled:opacity-50"
                    >
                        Ajouter souhait
                    </button>
                </Form>
            </div>
        </div>
    </div>
</template>
