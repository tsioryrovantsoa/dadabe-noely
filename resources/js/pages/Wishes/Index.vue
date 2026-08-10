<script setup lang="ts">
import { Form, Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { index as giftsIndex, show } from '@/routes/gifts';
import { destroy, update } from '@/routes/wishes';
import { validate } from '@/routes/wishlist';
import type { Wish } from '@/types';

defineOptions({ layout: ChristmasLayout });

defineProps<{
    wishes: Wish[];
    isValidated: boolean;
    spentPoints: number;
}>();

const page = usePage();

const child = computed(() => page.props.auth.child);

function removeWish(wish: Wish): void {
    if (confirm(`Retirer ${wish.gift.name} de ta liste ?`)) {
        router.delete(destroy(wish.id).url);
    }
}
</script>

<template>
    <Head title="Mes souhaits" />

    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="font-display text-4xl font-bold text-berry">
                Ma liste de souhaits
            </h1>
            <p v-if="child" class="mt-2 text-bark-soft">
                {{ spentPoints }} points utilisés sur {{ child.bonus_points }},
                il t'en reste
                <span class="font-semibold text-pine">{{
                    child.available_points
                }}</span>
                .
            </p>
        </div>

        <Link
            v-if="!isValidated"
            :href="giftsIndex()"
            class="text-sm text-bark-soft underline"
        >
            Ajouter d'autres cadeaux
        </Link>
    </div>

    <p
        v-if="isValidated"
        class="mt-6 rounded-cozy border border-pine-light/30 bg-pine-light/10 px-6 py-4 font-medium text-pine"
    >
        Ta liste est validée. Elle est partie chez le Père Noël et ne peut plus
        être modifiée.
    </p>

    <div v-if="wishes.length" class="mt-6 flex flex-col gap-4">
        <article
            v-for="wish in wishes"
            :key="wish.id"
            class="flex flex-wrap items-center gap-4 rounded-cozy bg-white p-4 shadow-sm"
        >
            <img
                v-if="wish.gift.image"
                :src="wish.gift.image"
                :alt="wish.gift.name"
                class="h-20 w-28 rounded-xl object-cover"
            />

            <div class="min-w-40 grow">
                <p class="text-xs tracking-wide text-bark-soft uppercase">
                    {{ wish.gift.category.name }}
                </p>
                <Link
                    :href="show(wish.gift.id)"
                    class="font-display text-lg font-semibold hover:text-berry"
                >
                    {{ wish.gift.name }}
                </Link>
                <p class="text-sm text-bark-soft">
                    {{ wish.gift.points }} points l'unité
                </p>
            </div>

            <p class="font-display text-lg font-bold text-pine">
                {{ wish.gift.points * wish.quantity }} pts
            </p>

            <Form
                v-if="!isValidated"
                v-bind="update.form(wish.id)"
                #default="{ errors, processing }"
                class="flex items-start gap-2"
            >
                <div class="flex flex-col gap-1">
                    <input
                        name="quantity"
                        type="number"
                        min="1"
                        max="20"
                        :value="wish.quantity"
                        class="w-20 rounded-xl border border-cream-dark px-3 py-2 focus:border-pine focus:outline-none"
                    />
                    <p v-if="errors.quantity" class="text-xs text-berry">
                        {{ errors.quantity }}
                    </p>
                </div>
                <button
                    type="submit"
                    :disabled="processing"
                    class="rounded-xl bg-pine px-4 py-2 text-sm font-medium text-cream hover:bg-pine-dark disabled:opacity-50"
                >
                    Modifier
                </button>
            </Form>

            <p v-else class="text-sm text-bark-soft">
                Quantité : {{ wish.quantity }}
            </p>

            <button
                v-if="!isValidated"
                type="button"
                class="cursor-pointer text-sm text-berry underline"
                @click="removeWish(wish)"
            >
                Retirer
            </button>
        </article>
    </div>

    <p v-else class="mt-6 rounded-cozy bg-white p-8 text-center text-bark-soft">
        Ta liste est vide.
        <Link :href="giftsIndex()" class="text-berry underline"
            >Découvre le catalogue</Link
        >.
    </p>

    <Form
        v-if="wishes.length && !isValidated"
        v-bind="validate.form()"
        #default="{ processing }"
        class="mt-10 rounded-cozy bg-white p-6 text-center shadow-sm"
    >
        <p class="text-bark-soft">
            Une fois validée, ta liste ne pourra plus être modifiée.
        </p>
        <button
            type="submit"
            :disabled="processing"
            class="mt-4 rounded-cozy bg-berry px-8 py-3 font-display text-lg font-semibold text-cream hover:bg-berry-dark disabled:opacity-50"
        >
            Valider ma liste
        </button>
    </Form>
</template>
