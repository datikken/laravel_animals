export const fetchAnimalByName = async (name) => {
  try {
    const { data } = await axios.get(`/animals/${name}`);
    return data;
  } catch(err) {
    console.warn(err)
  }
}
