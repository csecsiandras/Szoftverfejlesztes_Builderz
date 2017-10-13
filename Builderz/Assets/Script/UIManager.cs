using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class UIManager : MonoBehaviour {

    public RectTransform colorMenu;
    public RectTransform actionMenu;

    private bool menuAnimating;
    private bool areMenusShowing;
    private float menuAndimationTransition;
    private float animationDuration = 0.2f;

    private void Update()
    {
        if (Input.GetKeyDown(KeyCode.A))
            OnTheOneButtonClick();

        if(menuAnimating)
        {
            if (areMenusShowing)
            {
                menuAndimationTransition += Time.deltaTime * (1- animationDuration);
                if (menuAndimationTransition >= 1)
                {
                    menuAndimationTransition = 1;
                    menuAnimating = false;
                }
            }
            else
            {
                menuAndimationTransition -= Time.deltaTime * (1 - animationDuration);
                if (menuAndimationTransition <= 0)
                {
                    menuAndimationTransition = 0;
                    menuAnimating = false;
                }
            }

            colorMenu.anchoredPosition = Vector2.Lerp(new Vector2(0, 625), new Vector2(0, -125), menuAndimationTransition);
            actionMenu.anchoredPosition = Vector2.Lerp(new Vector2(-375, 0), new Vector2(125, 0), menuAndimationTransition);

        }
    }

    public void OnTheOneButtonClick()
    {
        areMenusShowing = !areMenusShowing;
        PlayMenuAnimation();
     
    }

    private void PlayMenuAnimation()
    {
        menuAnimating = true;
    }
}
